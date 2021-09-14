import { createSlice } from '@reduxjs/toolkit';
import axios from 'axios';
import { toast } from 'react-toastify';
import { API_URL } from '../../config';
import { getToken, getIsAdmin, removeAuth, setAuth } from '../../helpers/auth';

const initialState = {
	loading: false,
	isAuthenticated: undefined,
	user: null,
	error: null,
	isAdmin: null,
};

const authSlice = createSlice({
	name: 'auth',
	initialState,
	reducers: {
		login: state => ({
			...state,
			loading: true,
		}),
		loginSuccess: (state, action) => ({
			...state,
			loading: false,
			error: null,
			isAuthenticated: true,
			user: action.payload,
			isAdmin: action.payload.is_admin,
		}),
		loginFail: (state, action) => ({
			...state,
			loading: false,
			error: action.payload,
			isAuthenticated: false,
			isAdmin: null,
		}),
		register: state => ({
			...state,
			loading: true,
		}),
		registerSuccess: (state, action) => ({
			...state,
			loading: false,
			error: null,
			isAuthenticated: true,
			isAdmin: action.payload.is_admin,
		}),
		registerFail: (state, action) => ({
			...state,
			loading: false,
			error: action.payload,
			isAuthenticated: false,
			isAdmin: null,
		}),
		authenticate: (state, action) => ({
			...state,
			isAuthenticated: true,
			isAdmin: action.payload,
		}),
		clearAuthentication: state => ({
			...state,
			isAuthenticated: false,
			isAdmin: null,
		}),
	},
});

const authReducer = authSlice.reducer;

export const authenticate = () => {
	return dispatch => {
		const token = getToken();
		const isAdmin = getIsAdmin();

		if (!token) {
			return dispatch(clearAuthentication());
		}

		dispatch(authSlice.actions.authenticate(isAdmin));
	};
};

export const clearAuthentication = () => {
	removeAuth();

	return dispatch => {
		dispatch(authSlice.actions.clearAuthentication());
	};
};

export const login = data => {
	return dispatch => {
		dispatch(authSlice.actions.login());

		axios
			.post(`${API_URL}/login`, data)
			.then(r => r.data)
			.then(data => {
				const { token, user, error } = data;

				if (token) {
					setAuth(token, user.is_admin);
					dispatch(authSlice.actions.loginSuccess(user));
				} else if (error) {
					toast.error(error);
					dispatch(authSlice.actions.loginFail(error));
				}
			})
			.catch(error => {
				toast.error(error.response?.data?.message);
				dispatch(authSlice.actions.loginFail(error));
			});
	};
};

export const register = data => {
	return dispatch => {
		dispatch(authSlice.actions.register());

		axios
			.post(`${API_URL}/register`, data)
			.then(r => r.data)
			.then(data => {
				const { token, user, error } = data;

				if (token) {
					setAuth(token, user.is_admin);
					dispatch(authSlice.actions.registerSuccess(user));
				} else if (error) {
					toast.error(error);
					dispatch(authSlice.actions.registerFail(error));
				}
			})
			.catch(error => {
				dispatch(authSlice.actions.registerFail(error));
			});
	};
};

export default authReducer;
