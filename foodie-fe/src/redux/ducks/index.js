/**
 * We use 'Ducks' proposal for combining reducers,
 * actions, action creators and epics in one file
 *
 * For more information:
 * https://github.com/erikras/ducks-modular-redux
 */
import { combineReducers } from 'redux';
import authSlice from './auth';
import restaurantSlice from './restaurant';
import userSlice from './user';

const appReducer = combineReducers({
	auth: authSlice,
	user: userSlice,
	restaurant: restaurantSlice,
});

export const rootReducer = (state, action) => {
	return appReducer(state, action);
};
