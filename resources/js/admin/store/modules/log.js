import axios from 'axios';
import API from '@/admin/api';
import router from '@/admin/router';

const state = {
	isVerify: false,
	isVerifyLog: true,
	isResetPassword: false,
	isPreloader: false,
}

const getters = {
	isVerify: (state) => state.isVerify,
	isVerifyLog: (state) => state.isVerifyLog,
	isResetPassword: (state) => state.isResetPassword,
	isPreloader: (state) => state.isPreloader,
}


const actions = {
	preloader({ commit, getters, dispatch }) {
		document.documentElement.classList.remove('lock');
		commit("setIsPreloader", true)
	},
	async getScanLogCount({ commit, getters, dispatch }) {
		try {
			let response = await API.post('/api/admin/users/count');
			if (response && response.data && response.data.status > 0) {
				commit("setIsVerifyLog", true)
				dispatch("preloader")
			} else if (response && response.data && response.data.status === 0) {
				commit("setIsVerifyLog", false)
				dispatch("preloader")
			}
		} catch (error) {
		}
	},
	async scan({ commit, getters, dispatch }) {
		try {
			let response = await API.post('/api/admin/auth/status');
			if (response && response.data && response.data.status) {
				commit("setIsVerify", true)
				dispatch("preloader")
			} else {
				localStorage.removeItem("access_token")
				commit("setIsVerify", false)
			}
		} catch (error) {
			localStorage.removeItem("access_token")
			commit("setIsVerify", false)

			dispatch("getScanLogCount")
		}
	},
	async logout({ commit, getters, dispatch }) {
		try {
			await API.post("/api/admin/auth/logout");
		} finally {
			dispatch("zeroingLog")
		}
	},
	zeroingLog({ commit, getters, dispatch }) {
		localStorage.removeItem('access_token');
		commit("setIsVerify", false)
		commit("setIsPreloader", false)
		dispatch("getScanLogCount")
		document.documentElement.classList.add('lock');
	}
}


const mutations = {
	setIsVerify(state, isVerify) {
		state.isVerify = isVerify
	},
	setIsVerifyLog(state, isVerifyLog) {
		state.isVerifyLog = isVerifyLog
	},
	setIsPreloader(state, isPreloader) {
		state.isPreloader = isPreloader
	},
	setIsResetPassword(state, isResetPassword) {
		state.isResetPassword = isResetPassword
	},
}


export default {
	state, getters, actions, mutations
}