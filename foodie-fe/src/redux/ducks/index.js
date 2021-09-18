import { combineReducers } from 'redux';
import authSlice from './auth';
import restaurantSlice from './restaurant';
import userSlice from './user';
import orderSlice from './order';

const appReducer = combineReducers({
	auth: authSlice,
	user: userSlice,
	restaurant: restaurantSlice,
	order: orderSlice,
});

export const rootReducer = (state, action) => {
	if (action.type === 'auth/logout') {
		state = undefined;
	}
	return appReducer(state, action);
};
