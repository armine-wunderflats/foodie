import React from 'react';
import { connect } from 'react-redux';
import { Icon } from 'semantic-ui-react';
import Loader from '../../components/Loader';
import { register } from '../../redux/ducks/auth';
import RegistrationForm from '../../components/RegistrationForm';

const RegistrationScreen = ({ loading, history, register }) => {
	const onSubmit = data => register(data);

	return (
		<div id="auth_screen">
			<Icon
				name="arrow left"
				size="large"
				className="floatLeft goBack"
				onClick={() => history.goBack()}
			/>
			<Loader loading={loading} />
			<h1 className="darkBlue">Welcome to Foodie</h1>
			<h2 className="darkBlue">Please Register to Continue</h2>
			<RegistrationForm onSubmit={onSubmit} />
		</div>
	);
};

const mapStateToProps = state => ({
	loading: state.auth.loading,
});

const mapDispatchToProps = dispatch => ({
	register: data => dispatch(register(data)),
});

export default connect(mapStateToProps, mapDispatchToProps)(RegistrationScreen);
