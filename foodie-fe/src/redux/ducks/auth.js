import { createSlice } from '@reduxjs/toolkit';
import axios from 'axios';
import { toast } from 'react-toastify';
import { API_URL } from '../../config';
import { getToken, removeAuth, setAuth } from '../../helpers/auth';

const initialState = {
	loading: false,
	isAuthenticated: undefined,
	user: null,
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
			isAuthenticated: true,
			user: action.payload,
		}),
		loginFail: (state, action) => ({
			...state,
			loading: false,
			isAuthenticated: false,
		}),
		register: state => ({
			...state,
			loading: true,
		}),
		registerSuccess: (state, action) => ({
			...state,
			loading: false,
			isAuthenticated: true,
		}),
		registerFail: (state, action) => ({
			...state,
			loading: false,
			isAuthenticated: false,
		}),
		authenticate: (state, action) => ({
			...state,
			isAuthenticated: true,
		}),
		logout: state => ({
			...state,
			isAuthenticated: false,
		}),
	},
});

const authReducer = authSlice.reducer;

export const authenticate = () => {
	return dispatch => {
		const token = getToken();

		if (!token) {
			return dispatch(logout());
		}

		dispatch(authSlice.actions.authenticate());
	};
};

export const logout = () => {
	removeAuth();

	return dispatch => {
		dispatch(authSlice.actions.logout());
	};
};

export const login = data => {
	return dispatch => {
		dispatch(authSlice.actions.login());

		axios
			.post(`${API_URL}/login`, data)
			.then(r => r.data)
			.then(data => {
				const { token, user, message } = data;

				if (token) {
					setAuth(token);
					dispatch(authSlice.actions.loginSuccess(user));
				} else if (message) {
					toast.error(message);
					dispatch(authSlice.actions.loginFail(message));
				}
			})
			.catch(error => {
				dispatch(authSlice.actions.loginFail());
				toast.error(error.response?.data?.message);
			});
	};
};

export const register = data => {
	return dispatch => {
		dispatch(authSlice.actions.register());

		axios
			.post(`${API_URL}/register`, data)
			.then(r => r.data)
			.then(r => {
				const { token, data, message } = r;
				if (token) {
					setAuth(token);
					dispatch(authSlice.actions.registerSuccess(data));
				} else if (message) {
					toast.error(message);
					dispatch(authSlice.actions.registerFail(message));
				}
			})
			.catch(error => {
				dispatch(authSlice.actions.registerFail());
				const emailError = error.response?.data.errors?.email;
				if (emailError) return toast.error(emailError[0]);

				toast.error('Registration failed');
			});
	};
};

export default authReducer;
