import router from '@/admin/router';
import axios from 'axios';
import API from '@/admin/api';
import * as flsFunctions from "@/admin/files/functions.js";

const state = {
	isDeleteCategory: false,

	name: '',
	isName: false,
	name_valid_message: [],

	parent_id: null,
	isParentId: false,
	parent_id_valid_message: [],

	categories: [],
	category: [],
	categoryTitle: '',

	isCategories: true,
}

const getters = {
	isDeleteCategory: (state) => state.isDeleteCategory,

	name: (state) => state.name,
	isName: (state) => state.isName,
	name_valid_message: (state) => state.name_valid_message,

	parent_id: (state) => state.parent_id,
	isParentId: (state) => state.isParentId,
	parent_id_valid_message: (state) => state.parent_id_valid_message,

	categories: (state) => state.categories,
	category: (state) => state.category,
	categoryTitle: (state) => state.categoryTitle,

	isCategories: (state) => state.isCategories,
}


const actions = {
	zeroingCategory({ commit, getters, dispatch }) {
		commit('setTable', 1)
		commit('setName', '')
		commit('setIsName', false)
		commit('setNameValidMessage', [])
		commit('setParentId', null)
		commit('setIsParentId', false)
		commit('setParentIdValidMessage', [])
		commit('setIsReadOnly', false)
		commit('setLoading', false)
		commit('setResult', false)
		commit('setIsErrorResult', false)
		commit('setResultMessage', '')
		commit('setCategory', [])
		commit('setCategoryTitle', '')
	},
	async getCategories({ commit, getters, dispatch }) {
		try {
			let response = await axios.get('/api/categories');
			if (response && response.data && response.data.length > 0) {
				commit("setLazyLoading", false)
				commit("setCategories", response.data)
			} else {
				commit("setLazyLoading", false)
				commit("setIsCategories", false)
			}
		} catch (error) {
			commit("setLazyLoading", false)
			commit("setIsCategories", false)
		}
	},
	updateCategory({ commit, getters, dispatch }) {
		API.patch('/api/admin/categories', {id: getters.category[getters.category.length - 1].id, name: getters.name.trim(), parent_id: getters.parent_id})
		.then( response => {
			if (response && response.data) {
				if (response.data.message) {
					setTimeout(() => {
						commit('setTable', 1)
					}, 1400);

					dispatch("finishResult", { message: response.data.message });
				} else if (response.data.error) {
					dispatch("finishResult", {
						message: response.data.error,
						errorStatus: true,
					});
				} else {
					dispatch("finishResult", {
						message: 'Непредвиденная ошибка',
						errorStatus: true,
					});
				}
			} else {
				dispatch("finishResult", {
					message: 'Непредвиденная ошибка',
					errorStatus: true,
				});
			}
		})
		.catch( error => {
			if (error.response && error.response.data && error.response.data.error) {
				dispatch("finishResult", {
					message: error.response.data.error,
					errorStatus: true,
				});
			} else if (error.response && error.response.data && error.response.data.message) {
				dispatch("finishResult", {
					message: error.response.data.message,
					errorStatus: true,
				});
			} else {
				dispatch("finishResult", {
					message: 'Непредвиденная ошибка',
					errorStatus: true,
				});
			}
		});
	},
	storeCategory({ commit, getters, dispatch }) {
		API.post('/api/admin/categories', {name: getters.name.trim(), parent_id: getters.parent_id})
		.then( response => {
			if (response && response.data) {
				if (response.data.message) {
					setTimeout(() => {
						dispatch("zeroingCategory")
					}, 1400);

					dispatch("finishResult", { message: response.data.message });
				} else if (response.data.error) {
					dispatch("finishResult", {
						message: response.data.error,
						errorStatus: true,
					});
				} else {
					dispatch("finishResult", {
						message: 'Непредвиденная ошибка',
						errorStatus: true,
					});
				}
			} else {
				dispatch("finishResult", {
					message: 'Непредвиденная ошибка',
					errorStatus: true,
				});
			}
		})
		.catch( error => {
			if (error.response && error.response.data && error.response.data.error) {
				dispatch("finishResult", {
					message: error.response.data.error,
					errorStatus: true,
				});
			} else if (error.response && error.response.data && error.response.data.message) {
				dispatch("finishResult", {
					message: error.response.data.message,
					errorStatus: true,
				});
			} else {
				dispatch("finishResult", {
					message: 'Непредвиденная ошибка',
					errorStatus: true,
				});
			}
		});
	},
	sendCategory({ commit, getters, dispatch }, url) {
		commit("setIsReadOnly", true)
		commit("setLoading", true)

		commit("setIsName", false)
		commit("setNameValidMessage", [])

		commit("setIsParentId", false)
		commit("setParentIdValidMessage", [])

		switch (getters.table) {
			case 1:
				if (getters.name.toString().length < 3) {
					let message = getters.name_valid_message;
					message.push('Не менее 3 символов!')
					commit("setIsName", true)
					commit("setNameValidMessage", message)
				} else if (getters.name.toString().length > 250) {
					let message = getters.name_valid_message;
					message.push('Не более 250 символов!')
					commit("setIsName", true)
					commit("setNameValidMessage", message)
				}
				if (!getters.isName) {
					commit("setTable", (getters.table + 1))
					dispatch("finishResult", {
						message: 'Выберите категирию',
					});
				} else {
					dispatch("finishResult", {
						message: 'Ошибка валидации',
						errorStatus: true,
					});
				}
				break;
			case 2:
				if (getters.parent_id == null) {
					let message = ['Не обходимо выбрать!'];
					commit("setIsParentId", true)
					commit("setParentIdValidMessage", message)
				}
				if (!getters.isName && !getters.isParentId) {
					dispatch(url)
				} else {
					dispatch("finishResult", {
						message: 'Ошибка валидации',
						errorStatus: true,
					});
				}
				break;
		}
	},
	clearCategory({ commit, getters, dispatch }, ) {
		commit("setIsReadOnly", true)
		setTimeout(() => {
			commit("setIsReadOnly", false)
		}, 600);
		dispatch("removeHiddenCategories");
		commit("setCategoryTitle", '')
		commit("setParentId", null)
	},
	addClickCategory({ commit, getters, dispatch }, { id, event }) {
		dispatch("removeActiveCategories");
		let currentElement = event.target;
		commit("setParentId", id)
		let title = [];
		for (let i = 0; i < 6; i++) {
			const category = currentElement.hasAttribute('data-category-link');
			const hasDataMenu = currentElement.hasAttribute('data-category-menu');
			const hasDataSubmenu = currentElement.hasAttribute('data-category-submenu');
			if (category) {
				currentElement.classList.add('_show')

				title.push(currentElement.innerText.trim());

				i = 0
			}

			if (hasDataSubmenu) {
				currentElement.querySelector("[data-category-button]").classList.add('_show')

				title.push(currentElement.querySelector("[data-category-button]").innerText.trim());

				i = 0
			}
			if (hasDataMenu) {
				break;
			}
			currentElement = currentElement.parentElement;
		}

		const titleReversed = title.reverse()
		const titleString = titleReversed.join(' / ');

		commit("setCategoryTitle", titleString)
	},
	removeActiveCategories({ commit, getters, dispatch }) {
		const links = document.querySelectorAll('[data-category-link]._show, [data-category-button]._show');
		links.forEach(element => {
			element.classList.remove('_show');
		});
	},
	removeHiddenCategories({ commit, getters, dispatch }) {
		const buttons = document.querySelectorAll('[data-category-button]._show');
		buttons.forEach(element => {
			element.classList.remove('_show');
			flsFunctions._slideUp(element.nextElementSibling)
		});
		const links = document.querySelectorAll('[data-category-link]._show');
		links.forEach(element => {
			element.classList.remove('_show');
		});
	},
	async destroyCategory({ commit, getters, dispatch }, id) {
		try {
			let response = await API.delete('/api/admin/categories/' + id);
			if (response && response.data && response.data.message) {
				dispatch("finishResult", {
					message: response.data.message,
					errorStatus: true,
				});
				setTimeout(() => {
					router.push({ name: 'categories.edit'});
				}, 1400);
			}
		} catch (error) {
			if (error.response && error.response.data && error.response.data.error) {
				dispatch("finishResult", {
					message: error.response.data.error,
					errorStatus: true,
				});
			} else if (error.response && error.response.data && error.response.data.message) {
				dispatch("finishResult", {
					message: error.response.data.message,
					errorStatus: true,
				});
			} else {
				dispatch('finishResult', {
					message: 'Непредвиденная ошибка',
					errorStatus: true,
				});
			}
		}
	},
	deleteCategory({ commit, getters, dispatch }, id) {
		if (!getters.isDeleteCategory) {
			commit("setIsDeleteCategory", true)
			setTimeout(() => {
				commit("setIsDeleteCategory", false)
			}, 2600);
		} else {
			commit("setIsReadOnly", true)
			commit("setLoading", true)
			dispatch("destroyCategory", id)
			commit("setIsDeleteCategory", false)
		}
	},
}

const mutations = {
	setIsDeleteCategory(state, isDeleteCategory) {
		state.isDeleteCategory = isDeleteCategory
	},

	setName(state, name) {
		state.name = name
	},
	setIsName(state, isName) {
		state.isName = isName
	},
	setNameValidMessage(state, name_valid_message) {
		state.name_valid_message = name_valid_message
	},

	setParentId(state, parent_id) {
		state.parent_id = parent_id
	},
	setIsParentId(state, isParentId) {
		state.isParentId = isParentId
	},
	setParentIdValidMessage(state, parent_id_valid_message) {
		state.parent_id_valid_message = parent_id_valid_message
	},

	setCategory(state, category) {
		state.category = category
	},
	setCategories(state, categories) {
		state.categories = categories
	},
	setCategoryTitle(state, categoryTitle) {
		state.categoryTitle = categoryTitle
	},

	setIsCategories(state, isCategories) {
		state.isCategories = isCategories
	},
}


export default {
	state, getters, actions, mutations
}