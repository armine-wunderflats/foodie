import * as Yup from 'yup';

const mealSchema = Yup.object().shape({
	name: Yup.string().required('The name is required'),
	price: Yup.number().min(1, 'The price must be greater than 0').required('The price is required'),
	description: Yup.string(),
});

export default mealSchema;
