import { createSlice } from '@reduxjs/toolkit';
import axios from 'axios';
import { toast } from 'react-toastify';
import { API_URL } from '../../config';

const initialState = {
	loading: false,
	error: null,
	restaurant: null,
	restaurantList: null,
	current_page: 1,
};

const restaurantSlice = createSlice({
	name: 'restaurant',
	initialState,
	reducers: {
		getRestaurant: (state, action) => ({
			...state,
			loading: true,
			current_page: action.payload?.current_page,
		}),
		getRestaurantSuccess: (state, action) => ({
			...state,
			loading: false,
			error: null,
			restaurantList: action.payload,
		}),
		getRestaurantFail: (state, action) => ({
			...state,
			loading: false,
			error: action.payload,
		}),
		getRestaurantById: state => ({
			...state,
			restaurant: null,
			loading: true,
		}),
		getRestaurantByIdSuccess: (state, action) => ({
			...state,
			loading: false,
			error: null,
			restaurant: action.payload,
		}),
		getRestaurantByIdFail: (state, action) => ({
			...state,
			loading: false,
			error: action.payload,
		}),
		updateRestaurant: state => ({
			...state,
			loading: true,
			restaurant: null,
		}),
		updateRestaurantSuccess: (state, action) => ({
			...state,
			loading: false,
			error: null,
			restaurant: action.payload,
		}),
		updateRestaurantFail: (state, action) => ({
			...state,
			loading: false,
			error: action.payload,
		}),
		deleteRestaurantById: state => ({
			...state,
			loading: true,
			restaurant: null,
		}),
		deleteRestaurantByIdSuccess: (state, action) => ({
			...state,
			loading: false,
			error: null,
			restaurant: action.payload,
		}),
		deleteRestaurantByIdFail: (state, action) => ({
			...state,
			loading: false,
			error: action.payload,
		}),
		createRestaurant: state => ({
			...state,
			loading: true,
			restaurant: null,
		}),
		createRestaurantSuccess: (state, action) => ({
			...state,
			loading: false,
			error: null,
			restaurant: action.payload,
		}),
		createRestaurantFail: (state, action) => ({
			...state,
			loading: false,
			error: action.payload,
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
				dispatch(restaurantSlice.actions.getRestaurantFail(error));
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
				dispatch(restaurantSlice.actions.getRestaurantFail(error));
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
				dispatch(restaurantSlice.actions.getRestaurantByIdFail(error));
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
				dispatch(restaurantSlice.actions.deleteRestaurantByIdFail(error));
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
				dispatch(restaurantSlice.actions.createRestaurantFail(error));
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
				dispatch(restaurantSlice.actions.updateRestaurantFail(error));
			});
	};
};

export default restaurantReducer;
