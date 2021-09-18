import * as Yup from 'yup';

const restaurantSchema = Yup.object().shape({
	name: Yup.string().required('The name is required'),
	food_type: Yup.string().required('The food type is required'),
	description: Yup.string(),
});

export default restaurantSchema;
