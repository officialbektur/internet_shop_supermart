import router from '@/admin/router';
import axios from 'axios';
import API from '@/admin/api';

const state = {
	isDeleteSearchHint: false,

	searchhint: [],
	searchhintTitle: '',
}

const getters = {
	isDeleteSearchHint: (state) => state.isDeleteSearchHint,

	searchhint: (state) => state.searchhint,
	searchhintTitle: (state) => state.searchhintTitle,
}


const actions = {
	zeroingSearchHint({ commit, getters, dispatch }) {
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
		commit('setSearchhint', [])
		commit('setSearchhintTitle', '')
	},
	updateSearchHint({ commit, getters, dispatch }) {
		API.patch('/api/admin/searchhints', {id: getters.searchhint.id, name: getters.name.trim()})
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
	storeSearchHint({ commit, getters, dispatch }) {
		API.post('/api/admin/searchhints', {name: getters.name.trim()})
		.then( response => {
			if (response && response.data) {
				if (response.data.message) {
					setTimeout(() => {
						dispatch("zeroingSearchHint")
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
	sendSearchHint({ commit, getters, dispatch }, url) {
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
	clearSearchHint({ commit, getters, dispatch }, ) {
		commit("setIsReadOnly", true)
		setTimeout(() => {
			commit("setIsReadOnly", false)
		}, 600);
		dispatch("removeActiveCategories");
		commit("setSearchhintTitle", '')
		commit("setParentId", null)
	},
	addClickSearchHint({ commit, getters, dispatch }, { id, event }) {
		dispatch("removeActiveCategories");
		let currentElement = event.target;
		commit("setParentId", id)
		let title = [];
		for (let i = 0; i < 6; i++) {
			const SearchHint = currentElement.hasAttribute('data-SearchHint-link');
			const hasDataMenu = currentElement.hasAttribute('data-SearchHint-menu');
			const hasDataSubmenu = currentElement.hasAttribute('data-SearchHint-submenu');

			if (SearchHint) {
				currentElement.classList.add('_activeSearchHint')

				title.push(currentElement.innerText.trim());

				i = 0
			}

			if (hasDataSubmenu) {
				currentElement.querySelector("[data-SearchHint-button]").classList.add('_activeSearchHint')

				title.push(currentElement.querySelector("[data-SearchHint-button]").innerText.trim());

				i = 0
			}
			if (hasDataMenu) {
				break;
			}
			currentElement = currentElement.parentElement;
		}

		const titleReversed = title.reverse()
		const titleString = titleReversed.join(' / ');

		commit("setSearchhintTitle", titleString)
	},
	async destroySearchHint({ commit, getters, dispatch }, id) {
		try {
			let response = await API.delete('/api/admin/searchhints/' + id);
			if (response && response.data && response.data.message) {
				dispatch("finishResult", {
					message: response.data.message,
					errorStatus: true,
				});
				setTimeout(() => {
					router.push({ name: 'searchhints.index'});
				}, 1400);
			}
		} catch (error) {
			console.log(error);
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
	deleteSearchHint({ commit, getters, dispatch }, id) {
		if (!getters.isDeleteSearchHint) {
			commit("setIsDeleteSearchHint", true)
			setTimeout(() => {
				commit("setIsDeleteSearchHint", false)
			}, 2600);
		} else {
			commit("setIsReadOnly", true)
			commit("setLoading", true)
			dispatch("destroySearchHint", id)
			commit("setIsDeleteSearchHint", false)
		}
	},
}

const mutations = {
	setIsDeleteSearchHint(state, isDeleteSearchHint) {
		state.isDeleteSearchHint = isDeleteSearchHint
	},

	setSearchhint(state, searchhint) {
		state.searchhint = searchhint
	},
	setSearchhintTitle(state, searchhintTitle) {
		state.searchhintTitle = searchhintTitle
	},
}


export default {
	state, getters, actions, mutations
}