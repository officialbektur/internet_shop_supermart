import axios from 'axios';

const state = {
	table: 1,

	isReadOnly: false,

	loading: false,
	result: false,
	isErrorResult: false,

	resulMassage: '',
}

const getters = {
	table: (state) => state.table,

	isReadOnly: (state) => state.isReadOnly,
	loading: (state) => state.loading,
	result: (state) => state.result,
	isErrorResult: (state) => state.isErrorResult,
	resulMassage: (state) => state.resulMassage,
}


const actions = {
	validEmail({ commit, getters, dispatch }, email) {
		return !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,8})+$/.test(email);
	},
	finishResult({ commit, getters, dispatch }, { message, errorStatus = false }) {
		setTimeout(() => {
			commit("setResulMassage", message)
			commit("setResult", true)
			commit("setLoading", false)

			if (errorStatus) {
				commit("setIsErrorResult", true)
			}
			setTimeout(() => {
				commit("setResult", false)
				if (errorStatus) {
					commit("setIsErrorResult", false)
				}
				setTimeout(() => {
					commit("setIsReadOnly", false)
				}, 600);
			}, 1400);
		}, 600);
	},
	inputWatchName({ commit, getters, dispatch }, event) {
		commit('setName', event.target.value.trim())
	},
	back({ commit, getters, dispatch }, ) {
		let result = getters.table > 1 ? getters.table - 1 : 1
		commit("setTable", result)
	},
}


const mutations = {
	setTable(state, table) {
		state.table = table
	},
	setIsReadOnly(state, isReadOnly) {
		state.isReadOnly = isReadOnly
	},
	setLoading(state, loading) {
		state.loading = loading
	},
	setResult(state, result) {
		state.result = result
	},
	setIsErrorResult(state, isErrorResult) {
		state.isErrorResult = isErrorResult
	},
	setResulMassage(state, resulMassage) {
		state.resulMassage = resulMassage
	},
}


export default {
	state, getters, actions, mutations
}