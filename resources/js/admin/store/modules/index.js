import axios from 'axios';
import lazyMedia from "./../../files/scroll/lazyload.js";
const state = {
	app: null,
	accessToken: null,

	lazyLoading: true,
}

const getters = {
	app: (state) => state.app,
	accessToken: (state) => state.accessToken,

	lazyLoading: (state) => state.lazyLoading,
}


const actions = {
	lazyMedia({ commit }) {
		lazyMedia.update();
	},
	handleImageError({}, event) {
		event.target.src = `/storage/project/loading.gif`;
	},
	async getApp({ commit, getters, dispatch }){
		axios.get('/api/index')
		.then( res => {
			if (res && res.data) {
				commit("setApp", res.data)
			}
		})
	}
}


const mutations = {
	setApp(state, app) {
		state.app = app
	},
	setAccessToken(state, accessToken) {
		state.accessToken = accessToken
	},

	setLazyLoading(state, lazyLoading) {
		state.lazyLoading = lazyLoading
	},
}


export default {
	state, getters, actions, mutations
}