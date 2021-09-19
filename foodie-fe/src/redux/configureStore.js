import { configureStore as toolkitConfigureStore } from '@reduxjs/toolkit';
import { createLogger } from 'redux-logger';
import { rootReducer } from './ducks';

export const configureStore = () => {
	const preloadedState = {};
	const loggerMiddleware = createLogger();

	const store = toolkitConfigureStore({
		reducer: rootReducer,
		middleware: getDefaultMiddleware =>
			getDefaultMiddleware({
				serializableCheck: false,
			}).concat(loggerMiddleware),
		preloadedState, //initialState
	});

	return store;
};
