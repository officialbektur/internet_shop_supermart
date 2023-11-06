import axios from 'axios';
import API from '@/admin/api';
import router from '@/admin/router';

const state = {
}

const getters = {
}


const actions = {
	async getScanLogCount({ commit, getters, dispatch }, params = true) {
		API.post("/api/admin/users/count")
		.then( response => {
			if (response.data.status > 0 && params) {
				router.push({ name: 'users.login' })
			} else if (response.data.status == 0 && params) {
				router.push({ name: 'users.registration' })
			}
		})
	}
}


const mutations = {
}


export default {
	state, getters, actions, mutations
}