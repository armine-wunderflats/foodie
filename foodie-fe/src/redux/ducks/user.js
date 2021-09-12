import { createSlice } from '@reduxjs/toolkit';
import axios from 'axios';
import { toast } from 'react-toastify';
import { API_URL } from '../../config';

const initialState = {
	loading: false,
	error: null,
	currentUser: null,
};

const userSlice = createSlice({
	name: 'user',
	initialState,
	reducers: {
		getCurrentUser: state => ({
			...state,
			loading: true,
			currentUser: null,
		}),
		getCurrentUserSuccess: (state, action) => ({
			...state,
			loading: false,
			error: null,
			currentUser: action.payload,
		}),
		getCurrentUserFail: (state, action) => ({
			...state,
			loading: false,
			error: action.payload,
		}),
		updateUser: state => ({
			...state,
			loading: true,
			currentUser: null,
		}),
		updateUserSuccess: (state, action) => ({
			...state,
			loading: false,
			error: null,
			currentUser: action.payload,
		}),
		updateUserFail: (state, action) => ({
			...state,
			loading: false,
			error: action.payload,
		}),
	},
});

const userReducer = userSlice.reducer;

export const getCurrentUser = () => {
	console.log('CALLING getCurrentUser');
	return dispatch => {
		dispatch(userSlice.actions.getCurrentUser());

		axios
			.get(`${API_URL}/me`)
			.then(r => r.data)
			.then(data => {
				dispatch(userSlice.actions.getCurrentUserSuccess(data));
			})
			.catch(error => {
				dispatch(userSlice.actions.getCurrentUserFail(error));
			});
	};
};

export const updateUser = (id, data) => {
	return dispatch => {
		dispatch(userSlice.actions.updateUser());

		axios
			.put(`${API_URL}/users/${id}`, data)
			.then(r => r.data)
			.then(data => {
				dispatch(userSlice.actions.updateUserSuccess(data));
				toast.success('User update successful');
			})
			.catch(error => {
				dispatch(userSlice.actions.updateUserFail(error));
				toast.error('User update failed');
			});
	};
};

export default userReducer;
