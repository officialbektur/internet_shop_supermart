const state = {
	isActiveSearch: false
}


const getters = {
	isActiveSearch: (state) => state.isActiveSearch,
}


const actions = {
}


const mutations = {
	setIsActiveSearch(state, isActiveSearch) {
		state.isActiveSearch = isActiveSearch
	},
}


export default {
	state, getters, actions, mutations
}