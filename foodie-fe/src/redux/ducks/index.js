import { combineReducers } from 'redux';
import authSlice from './auth';
import restaurantSlice from './restaurant';
import userSlice from './user';
import orderSlice from './order';
import mealSlice from './meal';

const appReducer = combineReducers({
	auth: authSlice,
	user: userSlice,
	restaurant: restaurantSlice,
	order: orderSlice,
	meal: mealSlice,
});

export const rootReducer = (state, action) => {
	if (action.type === 'auth/logout') {
		state = undefined;
	}
	return appReducer(state, action);
};
