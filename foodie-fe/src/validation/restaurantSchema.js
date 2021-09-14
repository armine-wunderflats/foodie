import * as Yup from 'yup';

const restaurantSchema = Yup.object().shape({
	name: Yup.string().required('Name is reuqired'),
	food_type: Yup.string().required('The food type is reuqired'),
	description: Yup.string(),
});

export default restaurantSchema;
