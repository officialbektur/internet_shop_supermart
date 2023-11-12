const state = {
	app: null,
}

const getters = {
	app: (state) => state.app,
}


const actions = {
	async getApp({ getters, commit, dispatch }) {
		try {
			let response = await axios.get('/api/app');
			if (response && response.data) {
				commit("setApp", response.data)
			}
		} catch (error) {
		}
	},
	metaInfo({ getters, commit, dispatch }, { title, description = 'Все продукты у нас!' }) {
		if (document.title) {
			document.title = title;
		}

		const metaDescription = document.querySelector('meta[name="description"]');
		if (metaDescription) {
			metaDescription.setAttribute('content', description);
		}
	},
}


const mutations = {
	setApp(state, app) {
		state.app = app
	},
}


export default {
	state, getters, actions, mutations
}