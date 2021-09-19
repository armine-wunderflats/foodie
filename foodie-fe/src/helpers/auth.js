import axios from 'axios';
import constants from '../constants';
import store from '../redux/store';
import { logout } from '../redux/ducks/auth';

export const setAuth = token => localStorage.setItem(constants.token, token);
export const getToken = () => localStorage.getItem(constants.token);
export const removeAuth = () => localStorage.removeItem(constants.token);
export const getAuthHeader = () => {
	return { Authorization: `Bearer ${getToken()}` };
};
export const isAuthenticated = () => !!getToken();

axios.interceptors.request.use(
	config => {
		const token = getToken();
		if (token) {
			Object.assign(config.headers, getAuthHeader());
		}

		return config;
	},
	error => {
		return Promise.reject(error);
	}
);

axios.interceptors.response.use(
	response => response,
	async error => {
		if (error.config && error.response && error.response.status === 401) {
			store.dispatch(logout());
		}

		if (error.config && error.response && (error.response.status === 404 || error.response.status === 403)) {
			window.location.href = '/';
		}

		return Promise.reject(error);
	}
);
