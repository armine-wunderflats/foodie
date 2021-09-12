import * as Yup from 'yup';

const registrationSchema = Yup.object().shape({
	password: Yup.string().required('Passord is required'),
	name: Yup.string().required('Name is reuqired'),
	email: Yup.string()
		.email('The email is invalid')
		.required('Email is required'),
});

export default registrationSchema;
