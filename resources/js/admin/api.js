import axios from 'axios';
import store from './store/index.js';
import router from './router';

const api = axios.create();
api.interceptors.request.use(config => {
	if (localStorage.getItem('access_token') && localStorage.getItem('access_token').length > 0) {
		config.headers.authorization = `Bearer ${localStorage.getItem('access_token')}`;
	}
	return config;
}, error => {
	return Promise.reject(error);
});

api.interceptors.response.use(response => {
	return response;
}, error => {
	if (localStorage.getItem('access_token') && localStorage.getItem('access_token').length > 0) {
		if ('Token has expired' === error.response.data.message) {
			return axios.post('/api/admin/auth/refresh', {}, {
				headers: {
					'authorization': `Bearer ${localStorage.getItem('access_token')}`
				}
			})
			.then(res => {
				localStorage.setItem('access_token', res.data.access_token);
				error.config.headers.authorization = `Bearer ${res.data.access_token}`;
				return api.request(error.config);
			})
			.catch(err => {
				store.dispatch("zeroingLog")
				return Promise.reject(err);
			});
		}
	} else {
		store.dispatch("zeroingLog")
		return Promise.reject(error);
	}

	if (error.response.status === 401) {
		store.dispatch("zeroingLog")
		return Promise.reject(error);
	}

	return Promise.reject(error);
});

export default api;