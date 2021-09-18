import { createSlice } from '@reduxjs/toolkit';
import axios from 'axios';
import { toast } from 'react-toastify';
import { API_URL } from '../../config';
import constants from '../../constants';

const initialState = {
	loading: false,
	error: null,
	order: null,
	orderList: null,
};

const orderSlice = createSlice({
	name: 'order',
	initialState,
	reducers: {
		getOrders: (state, action) => ({
			...state,
			loading: true,
		}),
		getOrdersSuccess: (state, action) => ({
			...state,
			loading: false,
			error: null,
			orderList: action.payload,
		}),
		getOrdersFail: (state, action) => ({
			...state,
			loading: false,
			error: action.payload,
		}),
		getOrderById: state => ({
			...state,
			order: null,
			loading: true,
		}),
		getOrderByIdSuccess: (state, action) => ({
			...state,
			loading: false,
			error: null,
			order: action.payload,
		}),
		getOrderByIdFail: (state, action) => ({
			...state,
			loading: false,
			error: action.payload,
		}),
		updateOrderStatus: state => ({
			...state,
			loading: true,
			order: null,
		}),
		updateOrderStatusSuccess: (state, action) => ({
			...state,
			loading: false,
			error: null,
			order: action.payload,
		}),
		updateOrderStatusFail: (state, action) => ({
			...state,
			loading: false,
			error: action.payload,
		}),
		createOrder: state => ({
			...state,
			loading: true,
			order: null,
		}),
		createOrderSuccess: (state, action) => ({
			...state,
			loading: false,
			error: null,
			order: action.payload,
		}),
		createOrderFail: (state, action) => ({
			...state,
			loading: false,
			error: action.payload,
		}),
	},
});

const orderReducer = orderSlice.reducer;

export const getUserOrders = () => {
	return dispatch => {
		dispatch(orderSlice.actions.getOrders());

		axios
			.get(`${API_URL}/orders`)
			.then(r => r.data)
			.then(data => {
				dispatch(orderSlice.actions.getOrdersSuccess(data));
			})
			.catch(error => {
				dispatch(orderSlice.actions.getOrdersFail(error));
			});
	};
};

export const getRestaurantOrders = id => {
	return dispatch => {
		dispatch(orderSlice.actions.getOrders());

		axios
			.get(`${API_URL}/restaurants/${id}/orders`)
			.then(r => r.data)
			.then(data => {
				dispatch(orderSlice.actions.getOrdersSuccess(data));
			})
			.catch(error => {
				dispatch(orderSlice.actions.getOrdersFail(error));
			});
	};
};

export const getOrderById = id => {
	return dispatch => {
		dispatch(orderSlice.actions.getOrderById());

		axios
			.get(`${API_URL}/orders/${id}`)
			.then(r => r.data)
			.then(data => {
				dispatch(orderSlice.actions.getOrderByIdSuccess(data));
			})
			.catch(error => {
				dispatch(orderSlice.actions.getOrderByIdFail(error));
			});
	};
};

export const createOrder = (id, data) => {
	return dispatch => {
		dispatch(orderSlice.actions.createOrder());

		axios
			.post(`${API_URL}/restaurants/${id}/orders`, data)
			.then(r => r.data)
			.then(data => {
				dispatch(orderSlice.actions.createOrderSuccess(data));
				localStorage.setItem(constants.shoppingCart + id, JSON.stringify([]));
				toast.success('Order creation sucessful');
			})
			.catch(error => {
				toast.error('Order creation failed');
				dispatch(orderSlice.actions.createOrderFail(error));
			});
	};
};

export const updateOrderStatus = id => {
	return dispatch => {
		dispatch(orderSlice.actions.updateOrderStatus());

		axios
			.put(`${API_URL}/orders/${id}/status`, {})
			.then(r => r.data)
			.then(data => {
				dispatch(orderSlice.actions.updateOrderStatusSuccess(data));
				toast.success('Order update sucessful');
			})
			.catch(error => {
				toast.error('Order update failed');
				dispatch(orderSlice.actions.updateOrderStatusFail(error));
			});
	};
};

export default orderReducer;
