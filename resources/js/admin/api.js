import axios from 'axios';
import router from './router';

const api = axios.create();

api.interceptors.request.use(config =>  {
	if (localStorage.getItem('access_token')) {
		if (localStorage.getItem('access_token') !== 'undefined' || localStorage.getItem('access_token').length > 0) {
			config.headers.authorization = `Bearer ${localStorage.getItem('access_token')}`;
		}
	}
	return config;
}, error => {});

api.interceptors.response.use(response => {
		return response;
	}, error => {
	if ('Token has expired' === error.response.data.message) {
		return axios.post('/api/admin/auth/refresh', {}, {
			headers: {
			'authorization': `Bearer ${localStorage.getItem('access_token')}`
			}
		}).then(res => {
			localStorage.setItem('access_token', res.data.access_token);
			error.config.headers.authorization = `Bearer ${res.data.access_token}`;
			return api.request(error.config);
		});
	}
	if (error.response.status == 401) {
		localStorage.removeItem('access_token');
		router.push({name: 'users.login'});
	}

	return Promise.reject(error);
});

export default api