import { createSlice } from '@reduxjs/toolkit';
import axios from 'axios';
import { toast } from 'react-toastify';
import { API_URL } from '../../config';

const initialState = {
	loading: false,
	restaurant: null,
	restaurantList: null,
	current_page: 1,
	user_blocked: false,
};

const restaurantSlice = createSlice({
	name: 'restaurant',
	initialState,
	reducers: {
		getRestaurant: (state, action) => ({
			...state,
			loading: true,
			current_page: action.payload?.current_page,
			user_blocked: false,
		}),
		getRestaurantSuccess: (state, action) => ({
			...state,
			loading: false,
			restaurantList: action.payload,
		}),
		getRestaurantFail: state => ({
			...state,
			loading: false,
		}),
		getRestaurantById: state => ({
			...state,
			restaurant: null,
			user_blocked: false,
			loading: true,
		}),
		getRestaurantByIdSuccess: (state, action) => ({
			...state,
			loading: false,
			restaurant: action.payload,
		}),
		getRestaurantByIdFail: state => ({
			...state,
			loading: false,
		}),
		updateRestaurant: state => ({
			...state,
			loading: true,
			restaurant: null,
		}),
		updateRestaurantSuccess: (state, action) => ({
			...state,
			loading: false,
			restaurant: action.payload,
		}),
		updateRestaurantFail: state => ({
			...state,
			loading: false,
		}),
		deleteRestaurantById: state => ({
			...state,
			loading: true,
			restaurant: null,
		}),
		deleteRestaurantByIdSuccess: (state, action) => ({
			...state,
			loading: false,
			restaurant: action.payload,
		}),
		deleteRestaurantByIdFail: state => ({
			...state,
			loading: false,
		}),
		createRestaurant: state => ({
			...state,
			loading: true,
			restaurant: null,
		}),
		createRestaurantSuccess: (state, action) => ({
			...state,
			loading: false,
			restaurant: action.payload,
		}),
		createRestaurantFail: state => ({
			...state,
			loading: false,
		}),
		blockUser: state => ({
			...state,
			loading: true,
			user_blocked: false,
		}),
		blockUserSuccess: (state, action) => ({
			...state,
			loading: false,
			user_blocked: action.payload,
		}),
		blockUserFail: state => ({
			...state,
			loading: false,
		}),
	},
});

const restaurantReducer = restaurantSlice.reducer;

export const getRestaurants = (page = 1, filter = '') => {
	return dispatch => {
		dispatch(restaurantSlice.actions.getRestaurant({ page }));

		axios
			.get(`${API_URL}/restaurants?page=${page}&filter=${filter}`)
			.then(r => r.data)
			.then(data => {
				dispatch(restaurantSlice.actions.getRestaurantSuccess(data));
			})
			.catch(error => {
				dispatch(restaurantSlice.actions.getRestaurantFail());
			});
	};
};

export const getOwnerRestaurants = () => {
	return dispatch => {
		dispatch(restaurantSlice.actions.getRestaurant());

		axios
			.get(`${API_URL}/me/restaurants`)
			.then(data => {
				dispatch(restaurantSlice.actions.getRestaurantSuccess(data));
			})
			.catch(error => {
				dispatch(restaurantSlice.actions.getRestaurantFail());
			});
	};
};

export const getRestaurantById = id => {
	return dispatch => {
		dispatch(restaurantSlice.actions.getRestaurantById());

		axios
			.get(`${API_URL}/restaurants/${id}`)
			.then(r => r.data)
			.then(data => {
				dispatch(restaurantSlice.actions.getRestaurantByIdSuccess(data));
			})
			.catch(error => {
				dispatch(restaurantSlice.actions.getRestaurantByIdFail());
			});
	};
};

export const deleteRestaurantById = id => {
	return dispatch => {
		dispatch(restaurantSlice.actions.deleteRestaurantById());

		axios
			.delete(`${API_URL}/restaurants/${id}`)
			.then(() => {
				dispatch(restaurantSlice.actions.deleteRestaurantByIdSuccess());
				toast.success('Restaurant deletion sucessful');
			})
			.catch(error => {
				toast.error('Restaurant deletion failed');
				dispatch(restaurantSlice.actions.deleteRestaurantByIdFail());
			});
	};
};

export const createRestaurant = data => {
	return dispatch => {
		dispatch(restaurantSlice.actions.createRestaurant());

		axios
			.post(`${API_URL}/restaurants`, data)
			.then(r => r.data)
			.then(data => {
				dispatch(restaurantSlice.actions.createRestaurantSuccess(data));
				toast.success('Restaurant creation sucessful');
			})
			.catch(error => {
				toast.error('Restaurant creation failed');
				dispatch(restaurantSlice.actions.createRestaurantFail());
			});
	};
};

export const updateRestaurant = (id, data) => {
	return dispatch => {
		dispatch(restaurantSlice.actions.updateRestaurant());

		axios
			.put(`${API_URL}/restaurants/${id}`, data)
			.then(r => r.data)
			.then(data => {
				dispatch(restaurantSlice.actions.updateRestaurantSuccess(data));
				toast.success('Restaurant update sucessful');
			})
			.catch(error => {
				toast.error('Restaurant update failed');
				dispatch(restaurantSlice.actions.updateRestaurantFail());
			});
	};
};

export const blockUser = (id, data) => {
	return dispatch => {
		dispatch(restaurantSlice.actions.blockUser());

		axios
			.post(`${API_URL}/restaurants/${id}/block`, data)
			.then(r => {
				dispatch(restaurantSlice.actions.blockUserSuccess(true));
				toast.success('User blocked sucessfully');
			})
			.catch(error => {
				toast.error('Could not block user');
				dispatch(restaurantSlice.actions.blockUserFail());
			});
	};
};

export const unblockUser = (id, data) => {
	return dispatch => {
		dispatch(restaurantSlice.actions.blockUser());

		axios
			.post(`${API_URL}/restaurants/${id}/unblock`, data)
			.then(r => {
				dispatch(restaurantSlice.actions.blockUserSuccess(false));
				toast.success('User unblocked sucessfully');
			})
			.catch(error => {
				toast.error('Could not unblock user');
				dispatch(restaurantSlice.actions.blockUserFail());
			});
	};
};

export default restaurantReducer;
