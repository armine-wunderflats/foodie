import { createSlice } from '@reduxjs/toolkit';
import axios from 'axios';
import { toast } from 'react-toastify';
import { API_URL } from '../../config';

const initialState = {
	loading: false,
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
			currentUser: action.payload,
		}),
		getCurrentUserFail: state => ({
			...state,
			loading: false,
		}),
		updateUser: state => ({
			...state,
			loading: true,
			currentUser: null,
		}),
		updateUserSuccess: (state, action) => ({
			...state,
			loading: false,
			currentUser: action.payload,
		}),
		updateUserFail: state => ({
			...state,
			loading: false,
		}),
	},
});

const userReducer = userSlice.reducer;

export const getCurrentUser = () => {
	return dispatch => {
		dispatch(userSlice.actions.getCurrentUser());

		axios
			.get(`${API_URL}/me`)
			.then(r => r.data)
			.then(data => {
				dispatch(userSlice.actions.getCurrentUserSuccess(data));
			})
			.catch(error => {
				dispatch(userSlice.actions.getCurrentUserFail());
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
				dispatch(userSlice.actions.updateUserFail());
				toast.error('User update failed');
			});
	};
};

export default userReducer;
