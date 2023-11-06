import router from '@/admin/router';
import axios from 'axios';
import API from '@/admin/api';

const state = {
	linkingCategory: [],

	linkingCategoryIds: null,
	isLinkingCategoryId: false,

	linkingSpecificationIds: [],
	isLinkingSpecificationIds: false,
	linkingSpecificationsIdValidMessage: [],
}

const getters = {
	linkingCategory: (state) => state.linkingCategory,

	linkingCategoryIds: (state) => state.linkingCategoryIds,
	isLinkingCategoryId: (state) => state.isLinkingCategoryId,

	linkingSpecificationIds: (state) => state.linkingSpecificationIds,
	isLinkingSpecificationIds: (state) => state.isLinkingSpecificationIds,
	linkingSpecificationsIdValidMessage: (state) => state.linkingSpecificationsIdValidMessage,
}


const actions = {
	zeroingLinking({ commit, getters, dispatch }) {
		commit('setTable', 1)

		commit('setCategoryTitle', '')

		commit('setLinkingCategory', [])

		commit('setLinkingCategoryIds', null)
		commit('setIsLinkingCategoryId', false)

		dispatch('removeActiveCategories')
		commit('setLinkingSpecificationsIds', [])
		commit('setIsLinkingSpecificationIds', false)
		commit('setLinkingSpecificationsIdValidMessage', [])

		commit('setIsReadOnly', false)
		commit('setLoading', false)
		commit('setResult', false)
		commit('setIsErrorResult', false)
		commit('setResulMassage', '')
	},
	sendLinkingStore({ commit, getters, dispatch }) {
		API.post('/api/admin/category_specifications', {category_id: getters.linkingCategoryIds, specification_ids: getters.linkingSpecificationIds})
		.then( response => {
			if (response && response.data) {
				if (response.data.message) {
					setTimeout(() => {
						router.push({ name: 'categoryspecifications.index'});
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
				dispatch("finishResult", {
					message: 'Непредвиденная ошибка',
					errorStatus: true,
				});
			}
		});
	},
	sendLinking({ commit, getters, dispatch }, url) {
		commit("setIsReadOnly", true)
		commit("setLoading", true)

		commit("setIsLinkingCategoryId", false)
		commit("setIsLinkingSpecificationIds", false)
		commit("setLinkingSpecificationsIdValidMessage", [])
		if (!getters.linkingCategoryIds) {
			let message = ['Выберите категорию!'];
			commit("setIsLinkingCategoryId", true)
			commit("setLinkingSpecificationsIdValidMessage", message)
			router.push({ name: 'categoryspecifications.index'});
		}
		if (getters.linkingSpecificationIds.length == 0) {
			let message = ['Не обходимо выбрать!'];
			commit("setIsLinkingSpecificationIds", true)
			commit("setLinkingSpecificationsIdValidMessage", message)
		}
		if (!getters.isLinkingCategoryId && !getters.isLinkingSpecificationIds) {
			dispatch(url)
		} else {
			dispatch("finishResult", {
				message: 'Ошибка валидации',
				errorStatus: true,
			});
		}
	},
	addClickLinkingSpecification({ commit, getters, dispatch }, {id, event}) {
		dispatch("removeActiveCategories");
		let ids = getters.linkingSpecificationIds;
		let button = event.target;
		button.classList.toggle('_show')
		let status = ids.indexOf(id);
		if (status != -1) {
			ids.splice(status, 1);
		} else {
			ids.push(id);
		}
		commit("setLinkingSpecificationsIds", ids)
	},
}

const mutations = {
	setLinkingCategory(state, linkingCategory) {
		state.linkingCategory = linkingCategory
	},
	setLinkingCategoryIds(state, linkingCategoryIds) {
		state.linkingCategoryIds = linkingCategoryIds
	},
	setIsLinkingCategoryId(state, isLinkingCategoryId) {
		state.isLinkingCategoryId = isLinkingCategoryId
	},

	setLinkingSpecificationsIds(state, linkingSpecificationIds) {
		state.linkingSpecificationIds = linkingSpecificationIds
	},
	setIsLinkingSpecificationIds(state, isLinkingSpecificationIds) {
		state.isLinkingSpecificationIds = isLinkingSpecificationIds
	},
	setLinkingSpecificationsIdValidMessage(state, linkingSpecificationsIdValidMessage) {
		state.linkingSpecificationsIdValidMessage = linkingSpecificationsIdValidMessage
	},
}


export default {
	state, getters, actions, mutations
}