import axios from 'axios';

const state = {
}

const getters = {
}


const actions = {
	validEmail({ commit, getters, dispatch }, email) {
		return !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,8})+$/.test(email);
	}
}


const mutations = {
}


export default {
	state, getters, actions, mutations
}