const state = {
	commentariesCount: 0,
	apiSrcCommentaries: null,
	commentaries: [],
	countCommentaryTovars: 0,
	pageCommentaries: 0,
}


const getters = {
	commentariesCount: (state) => state.commentariesCount,
	apiSrcCommentaries: (state) => state.apiSrcCommentaries,
	pageCommentaries: (state) => state.pageCommentaries,
	commentaries: (state) => state.commentaries,
	countCommentaryTovars: (state) => (state.saveTovarCommentaries.length > 99 ? '99+' : state.saveTovarCommentaries.length),
}


const actions = {
	updateCommentaries({ commit }) {
		commit("setIsLoading", true);
	},
	zeroingCommentaries({ commit, getters, dispatch }){
		commit('setIsMessage', false);
		commit('setCommentaries', []);
		commit('setIsLoading', true);
		commit('setPageCommentaries', 0);
	},
	initializeCommentaries({ commit, getters, dispatch }) {
		dispatch('getCommentaries');
	},
	loadMoreButtonCommentaries({ getters, commit, dispatch }) {
		dispatch('getCommentaries');
	},
	async getCommentaries({ commit, getters, dispatch }) {
		commit('setPageCommentaries', getters.pageCommentaries + 1)
		try {
			let response = await axios.get('/api/' + getters.apiSrcCommentaries + '?page=' + getters.pageCommentaries);
			if (response && response.data && response.data.length > 0) {
				if (getters.pageCommentaries == 1) {
					commit("setCommentaries", []);
					commit("setCommentaries", response.data);
				} else {
					let commentaries = getters.commentaries;
					commentaries.push(...response.data);
					commit("setCommentaries", commentaries);
				}
			} else {
				if (getters.commentaries.length > 0) {
					commit("setIsLoading", false);
				} else {
					commit('setIsMessage', true)
					commit("setIsLoading", false);
				}
			}
		} catch (error) {
			if (getters.commentaries.length > 0) {
				commit('setIsMessage', true)
				commit("setIsLoading", false);
			}
		}
	},
}


const mutations = {
	setCommentariesCount(state, commentariesCount) {
		state.commentariesCount = commentariesCount
	},
	setApiSrcCommentaries(state, apiSrcCommentaries) {
		state.apiSrcCommentaries = apiSrcCommentaries
	},
	setPageCommentaries(state, pageCommentaries) {
		state.pageCommentaries = pageCommentaries
	},
	setCommentaries(state, commentaries) {
		state.commentaries = commentaries
	},
}


export default {
	state, getters, actions, mutations
}