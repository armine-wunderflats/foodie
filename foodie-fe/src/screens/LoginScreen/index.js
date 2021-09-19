import React from 'react';
import { connect } from 'react-redux';
import { Formik, Form } from 'formik';
import { Input, FormField, Button, Icon } from 'semantic-ui-react';
import { Link } from 'react-router-dom';

import Loader from '../../components/Loader';
import PasswordInput from '../../components/PasswordInput';
import schema from '../../validation/loginSchema';
import Validation from '../../validation';
import { login } from '../../redux/ducks/auth';

const LoginScreen = ({ loading, login }) => {
	const onSubmit = data => {
		login(data);
	};

	return (
		<div id="login_screen">
			<Loader loading={loading} />
			<h1 className="darkBlue">Welcome to Foodie</h1>
			<h2 className="darkBlue">Please Login to Continue</h2>
			<div className="container">
				<Formik
					initialValues={{
						email: '',
						password: '',
					}}
					validationSchema={schema}
					onSubmit={onSubmit}
					render={props => {
						const { values } = props;

						return (
							<Form className="ui form">
								<div className="login_container">
									<div>
										<FormField>
											<label htmlFor="email" className="label">
												<span>Email</span>
											</label>
											<Validation name="email" showMessage={true}>
												<Input autoCapitalize="off" value={values.email} name="email" />
											</Validation>
										</FormField>
										<FormField>
											<label htmlFor="password" className="label">
												<span>Password</span>
											</label>
											<Validation name="password" showMessage={true}>
												<PasswordInput value={values.password} name="password" />
											</Validation>
										</FormField>
									</div>
									<Button type="submit" secondary onSubmit={props.onSubmit} className="login">
										Login
										<Icon name="sign-in" />
									</Button>
								</div>
							</Form>
						);
					}}
				/>
				<Button secondary basic className="register" as={Link} to="/register">
					Register
					<Icon name="signup" />
				</Button>
			</div>
		</div>
	);
};

const mapStateToProps = state => ({
	loading: state.auth.loading,
});

const mapDispatchToProps = dispatch => ({
	login: (email, password) => dispatch(login(email, password)),
});

export default connect(mapStateToProps, mapDispatchToProps)(LoginScreen);
