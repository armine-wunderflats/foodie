import * as Yup from 'yup';

const loginSchema = Yup.object().shape({
	password: Yup.string().required('Passord is required'),
	email: Yup.string().email('The email is invalid').required('Email is required'),
});

export default loginSchema;
