import React from 'react';
import { Formik, Form } from 'formik';
import { Input, FormField, Button } from 'semantic-ui-react';
import PasswordInput from './PasswordInput';
import schema from '../validation/registrationSchema';
import Validation from '../validation';

const RegistrationForm = onSubmit => {
	return (
		<div className="container">
			<Formik
				initialValues={{
					name: '',
					password: '',
					email: '',
				}}
				validationSchema={schema}
				onSubmit={onSubmit}
				render={props => {
					const { values } = props;

					return (
						<Form className="ui form">
							<div className="auth_container">
								<div>
									<FormField>
										<label htmlFor="name" className="label">
											<span>Name</span>
										</label>
										<Validation name="name" showMessage={true}>
											<Input
												autoCapitalize="off"
												value={values.name}
												name="name"
											/>
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
									<FormField>
										<label htmlFor="email" className="label">
											<span>Email</span>
										</label>
										<Validation name="email" showMessage={true}>
											<Input
												autoCapitalize="off"
												value={values.email}
												name="email"
											/>
										</Validation>
									</FormField>
								</div>
								<Button
									type="submit"
									secondary
									onSubmit={props.onSubmit}
									className="register"
								>
									Register
								</Button>
							</div>
						</Form>
					);
				}}
			/>
		</div>
	);
};

export default RegistrationForm;
