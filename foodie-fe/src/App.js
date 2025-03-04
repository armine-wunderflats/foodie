import React, { useEffect } from 'react';
import { withRouter, Switch } from 'react-router-dom';
import { compose } from 'redux';
import { connect } from 'react-redux';
import './App.css';
import AuthenticationRoute from './components/AuthenticationRoute';
import { authenticate } from './redux/ducks/auth';
import HomeScreen from './screens/HomeScreen/index.js';
import LoginScreen from './screens/LoginScreen/index.js';
import RestaurantScreen from './screens/RestaurantScreen/index.js';
import RegistrationScreen from './screens/RegistrationScreen/index.js';
import OrderScreen from './screens/OrderScreen/index.js';
import SingleOrder from './screens/OrderScreen/SingleOrder.js';
import CreateRestaurantScreen from './screens/CreateRestaurantScreen/index.js';
import EditRestaurantScreen from './screens/EditRestaurantScreen/index.js';
import CreateMealScreen from './screens/CreateMealScreen/index.js';
import EditMealScreen from './screens/EditMealScreen/index.js';

const App = ({ authenticate }) => {
	useEffect(() => {
		authenticate();
	}, []);

	return (
		<div className="App">
			<Switch>
				<AuthenticationRoute
					path="/login"
					withAuth={false}
					component={LoginScreen}
					redirectOnFailure="/"
				/>
				<AuthenticationRoute
					path="/register"
					withAuth={false}
					component={RegistrationScreen}
					redirectOnFailure="/"
				/>
				<AuthenticationRoute
					path="/restaurants/:id/edit"
					withAuth
					component={EditRestaurantScreen}
					redirectOnFailure="/login"
				/>
				<AuthenticationRoute
					path="/restaurants/create"
					withAuth
					component={CreateRestaurantScreen}
					redirectOnFailure="/login"
				/>
				<AuthenticationRoute
					path="/restaurants/:id/meals/create"
					withAuth
					component={CreateMealScreen}
					redirectOnFailure="/login"
				/>
				<AuthenticationRoute
					path="/restaurants/:id/meals/:mealId/edit"
					withAuth
					component={EditMealScreen}
					redirectOnFailure="/login"
				/>
				<AuthenticationRoute
					path="/restaurants/:id/orders"
					withAuth
					component={OrderScreen}
					redirectOnFailure="/login"
				/>
				<AuthenticationRoute
					path="/restaurants/:id"
					withAuth
					component={RestaurantScreen}
					redirectOnFailure="/login"
				/>
				<AuthenticationRoute
					path="/orders/:id"
					withAuth
					component={SingleOrder}
					redirectOnFailure="/login"
				/>
				<AuthenticationRoute
					path="/orders"
					withAuth
					component={OrderScreen}
					redirectOnFailure="/login"
				/>
				<AuthenticationRoute
					path="/"
					withAuth
					component={HomeScreen}
					redirectOnFailure="/login"
				/>
			</Switch>
		</div>
	);
};

const mapDispatchToProps = dispatch => ({
	authenticate: () => dispatch(authenticate()),
});

const mapStateToProps = state => ({
	isAuthenticated: state.auth.isAuthenticated,
});

export default compose(
	withRouter,
	connect(mapStateToProps, mapDispatchToProps)
)(App);
