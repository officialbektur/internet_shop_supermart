import router from '@/admin/router';
import axios from 'axios';
import API from '@/admin/api';

const state = {
	isDeleteSpecification: false,

	specifications: [],
	specification: [],
	specificationTitle: '',

	isSpecifications: true,
}

const getters = {
	isDeleteSpecification: (state) => state.isDeleteSpecification,

	specifications: (state) => state.specifications,
	specification: (state) => state.specification,
	specificationTitle: (state) => state.specificationTitle,

	isSpecifications: (state) => state.isSpecifications,
}


const actions = {
	zeroingSpecification({ commit, getters, dispatch }) {
		commit("setIsSpecifications", true)
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
		commit('setSpecifications', [])
		commit('setSpecification', [])
		commit('setSpecificationTitle', '')
	},
	async getSpecifications({ commit, getters, dispatch }) {
		try {
			let response = await axios.get('/api/specifications');
			if (response && response.data && response.data.length > 0) {
				commit("setLazyLoading", false)
				commit("setSpecifications", response.data)
			} else {
				commit("setLazyLoading", false)
				commit("setIsSpecifications", false)
			}
		} catch (error) {
			commit("setLazyLoading", false)
			commit("setIsSpecifications", false)
		}
	},
	async getSpecificationsChildrens({ commit, getters, dispatch }) {
		try {
			let response = await API.get('/api/admin/specifications/childrens');
			if (response && response.data && response.data.length > 0) {
				commit("setSpecifications", response.data)
			} else {
				commit("setIsSpecifications", false)
			}
		} catch (error) {
			commit("setIsSpecifications", false)
		}
		dispatch("preloaderСategorySpecification")
	},
	updateSpecification({ commit, getters, dispatch }) {
		API.patch('/api/admin/specifications', {id: getters.specification[getters.specification.length - 1].id, name: getters.name.trim(), parent_id: getters.parent_id})
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
	storeSpecification({ commit, getters, dispatch }) {
		API.post('/api/admin/specifications', {name: getters.name.trim(), parent_id: getters.parent_id})
		.then( response => {
			if (response && response.data) {
				if (response.data.message) {
					setTimeout(() => {
						dispatch("zeroingSpecification")
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
	sendSpecification({ commit, getters, dispatch }, url) {
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
						message: 'Выберите характеристику',
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
	clearSpecification({ commit, getters, dispatch }, ) {
		commit("setIsReadOnly", true)
		setTimeout(() => {
			commit("setIsReadOnly", false)
		}, 600);
		dispatch("removeActiveCategories");
		commit("setSpecificationTitle", '')
		commit("setParentId", null)
	},
	addClickSpecification({ commit, getters, dispatch }, { id, event }) {
		dispatch("removeActiveCategories");
		let currentElement = event.target;
		commit("setParentId", id)
		let title = [];
		for (let i = 0; i < 6; i++) {
			const specification = currentElement.hasAttribute('data-category-link');
			const hasDataMenu = currentElement.hasAttribute('data-category-menu');
			const hasDataSubmenu = currentElement.hasAttribute('data-category-submenu');

			if (specification) {
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

		commit("setSpecificationTitle", titleString)
	},
	async destroySpecification({ commit, getters, dispatch }, id) {
		try {
			let response = await API.delete('/api/admin/specifications/' + id);
			if (response && response.data && response.data.message) {
				dispatch("finishResult", {
					message: response.data.message,
					errorStatus: true,
				});
				setTimeout(() => {
					router.push({ name: 'specifications.edit'});
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
	deleteSpecification({ commit, getters, dispatch }, id) {
		if (!getters.isDeleteSpecification) {
			commit("setIsDeleteSpecification", true)
			setTimeout(() => {
				commit("setIsDeleteSpecification", false)
			}, 2600);
		} else {
			commit("setIsReadOnly", true)
			commit("setLoading", true)
			dispatch("destroySpecification", id)
			commit("setIsDeleteSpecification", false)
		}
	},
}

const mutations = {
	setIsDeleteSpecification(state, isDeleteSpecification) {
		state.isDeleteSpecification = isDeleteSpecification
	},

	setSpecification(state, specification) {
		state.specification = specification
	},
	setSpecifications(state, specifications) {
		state.specifications = specifications
	},
	setSpecificationTitle(state, specificationTitle) {
		state.specificationTitle = specificationTitle
	},

	setIsSpecifications(state, isSpecifications) {
		state.isSpecifications = isSpecifications
	},
}


export default {
	state, getters, actions, mutations
}