import { createSlice } from '@reduxjs/toolkit';
import axios from 'axios';
import { toast } from 'react-toastify';
import { API_URL } from '../../config';

const initialState = {
	loading: false,
	meal: null,
};

const mealSlice = createSlice({
	name: 'meal',
	initialState,
	reducers: {
		getMealById: state => ({
			...state,
			meal: null,
			loading: true,
		}),
		getMealByIdSuccess: (state, action) => ({
			...state,
			loading: false,
			meal: action.payload,
		}),
		getMealByIdFail: state => ({
			...state,
			loading: false,
		}),
		updateMeal: state => ({
			...state,
			loading: true,
			meal: null,
		}),
		updateMealSuccess: (state, action) => ({
			...state,
			loading: false,
			meal: action.payload,
		}),
		updateMealFail: state => ({
			...state,
			loading: false,
		}),
		deleteMealById: state => ({
			...state,
			loading: true,
			meal: null,
		}),
		deleteMealByIdSuccess: (state, action) => ({
			...state,
			loading: false,
			meal: action.payload,
		}),
		deleteMealByIdFail: state => ({
			...state,
			loading: false,
		}),
		createMeal: state => ({
			...state,
			loading: true,
			meal: null,
		}),
		createMealSuccess: (state, action) => ({
			...state,
			loading: false,
			meal: action.payload,
		}),
		createMealFail: state => ({
			...state,
			loading: false,
		}),
	},
});

const mealReducer = mealSlice.reducer;

export const getMealById = id => {
	return dispatch => {
		dispatch(mealSlice.actions.getMealById());

		axios
			.get(`${API_URL}/meals/${id}`)
			.then(r => r.data)
			.then(data => {
				dispatch(mealSlice.actions.getMealByIdSuccess(data));
			})
			.catch(error => {
				dispatch(mealSlice.actions.getMealByIdFail());
			});
	};
};

export const deleteMealById = id => {
	return dispatch => {
		dispatch(mealSlice.actions.deleteMealById());

		axios
			.delete(`${API_URL}/meals/${id}`)
			.then(() => {
				dispatch(mealSlice.actions.deleteMealByIdSuccess());
				toast.success('Meal deletion sucessful');
			})
			.catch(error => {
				toast.error('Meal deletion failed');
				dispatch(mealSlice.actions.deleteMealByIdFail());
			});
	};
};

export const createMeal = (id, data) => {
	return dispatch => {
		dispatch(mealSlice.actions.createMeal());

		axios
			.post(`${API_URL}/restaurants/${id}/meals`, data)
			.then(r => r.data)
			.then(data => {
				dispatch(mealSlice.actions.createMealSuccess(data));
				toast.success('Meal creation sucessful');
			})
			.catch(error => {
				toast.error('Meal creation failed');
				dispatch(mealSlice.actions.createMealFail());
			});
	};
};

export const updateMeal = (id, data) => {
	return dispatch => {
		dispatch(mealSlice.actions.updateMeal());

		axios
			.put(`${API_URL}/meals/${id}`, data)
			.then(r => r.data)
			.then(data => {
				dispatch(mealSlice.actions.updateMealSuccess(data));
				toast.success('Meal update sucessful');
			})
			.catch(error => {
				toast.error('Meal update failed');
				dispatch(mealSlice.actions.updateMealFail());
			});
	};
};

export default mealReducer;
