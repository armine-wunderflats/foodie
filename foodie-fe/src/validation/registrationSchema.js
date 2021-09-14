import * as Yup from 'yup';

const registrationSchema = Yup.object().shape({
	password: Yup.string()
		.required('Passord is required')
		.min(6, 'The password must have at least 6 characters')
		.max(50, 'The password must have at most 50 characters'),
	name: Yup.string().required('Name is reuqired'),
	email: Yup.string()
		.email('The email is invalid')
		.required('Email is required'),
});

export default registrationSchema;
