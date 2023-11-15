import router from '@/admin/router';
import axios from 'axios';
import API from '@/admin/api';

const state = {
	isDeleteTag: false,

	tags: [],
	tag: [],
	tagTitle: '',

	isTags: true,
}

const getters = {
	isDeleteTag: (state) => state.isDeleteTag,

	tags: (state) => state.tags,
	tag: (state) => state.tag,
	tagTitle: (state) => state.tagTitle,

	isTags: (state) => state.isTags,
}


const actions = {
	zeroingTag({ commit, getters, dispatch }) {
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
		commit('setTag', [])
		commit('setTagTitle', '')
	},
	async getTags({ commit, getters, dispatch }) {
		try {
		let response = await API.get('/api/admin/tags');
			if (response && response.data && response.data.length > 0) {
				commit("setLazyLoading", false)
				commit("setTags", response.data)
			} else {
				commit("setLazyLoading", false)
				commit("setIsTags", false)
			}
		} catch (error) {
			commit("setLazyLoading", false)
			commit("setIsTags", false)
		}
	},
	updateTag({ commit, getters, dispatch }) {
		API.patch('/api/admin/tags', {id: getters.tag.id, name: getters.name.trim()})
		.then( response => {
			if (response && response.data) {
				if (response.data.message) {
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
	storeTag({ commit, getters, dispatch }) {
		API.post('/api/admin/tags', {name: getters.name.trim()})
		.then( response => {
			if (response && response.data) {
				if (response.data.message) {
					setTimeout(() => {
						dispatch("zeroingTag")
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
	sendTag({ commit, getters, dispatch }, url) {
		commit("setIsReadOnly", true)
		commit("setLoading", true)

		commit("setIsName", false)
		commit("setNameValidMessage", [])

		commit("setIsParentId", false)
		commit("setParentIdValidMessage", [])

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
			dispatch(url)
		} else {
			dispatch("finishResult", {
				message: 'Ошибка валидации',
				errorStatus: true,
			});
		}
	},
	clearTag({ commit, getters, dispatch }, ) {
		commit("setIsReadOnly", true)
		setTimeout(() => {
			commit("setIsReadOnly", false)
		}, 600);
		dispatch("removeActiveCategories");
		commit("setTagTitle", '')
		commit("setParentId", null)
	},
	addClickTag({ commit, getters, dispatch }, { id, event }) {
		let currentElement = event.target;
		commit("setParentId", id)
		let title = [];
		dispatch("removeActiveCategories");
		for (let i = 0; i < 6; i++) {
			const category = currentElement.hasAttribute('data-category-link');
			const hasDataMenu = currentElement.hasAttribute('data-category-menu');
			const hasDataSubmenu = currentElement.hasAttribute('data-category-submenu');

			if (category) {
				currentElement.classList.add('_activeCategory')

				title.push(currentElement.innerText.trim());

				i = 0
			}

			if (hasDataSubmenu) {
				currentElement.querySelector("[data-category-button]").classList.add('_activeCategory')

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

		commit("setTagTitle", titleString)
	},
	async destroyTag({ commit, getters, dispatch }, id) {
		try {
			let response = await API.delete('/api/admin/tags/' + id);
			if (response && response.data && response.data.message) {
				dispatch("finishResult", {
					message: response.data.message,
					errorStatus: true,
				});
				setTimeout(() => {
					router.push({ name: 'tags.index'});
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
	deleteTag({ commit, getters, dispatch }, id) {
		if (!getters.isDeleteTag) {
			commit("setIsDeleteTag", true)
			setTimeout(() => {
				commit("setIsDeleteTag", false)
			}, 2600);
		} else {
			commit("setIsReadOnly", true)
			commit("setLoading", true)
			dispatch("destroyTag", id)
			commit("setIsDeleteTag", false)
		}
	},
}

const mutations = {
	setIsDeleteTag(state, isDeleteTag) {
		state.isDeleteTag = isDeleteTag
	},

	setTag(state, tag) {
		state.tag = tag
	},
	setTags(state, tags) {
		state.tags = tags
	},
	setTagTitle(state, tagTitle) {
		state.tagTitle = tagTitle
	},

	setIsTags(state, isTags) {
		state.isTags = isTags
	},
}


export default {
	state, getters, actions, mutations
}