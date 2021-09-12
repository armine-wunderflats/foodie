import React, { useEffect } from 'react';
import { withRouter, Switch } from 'react-router-dom';
import { compose } from 'redux';
import { connect } from 'react-redux';
import './App.css';
import AuthenticationRoute from './components/AuthenticationRoute';
import { authenticate } from './redux/ducks/auth';
import HomeScreen from './screens/HomeScreen/index.js';
import LoginScreen from './screens/LoginScreen/index.js';
import RegistrationScreen from './screens/RegistrationScreen/index.js';

const App = ({ authenticate }) => {
	useEffect(() => {
		authenticate();
		console.log('Calling authenticate');
	}, [authenticate]);

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
					path="/"
					withAuth={true}
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
