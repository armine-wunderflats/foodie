import React from 'react';
import { connect } from 'react-redux';
import { useParams } from 'react-router';

import schema from '../../validation/mealSchema';
import { createMeal } from '../../redux/ducks/meal';
import MealForm from '../../components/MealForm';

const CreateMealScreen = ({ createMeal }) => {
	const { id } = useParams();
	const handleCreate = data => createMeal(id, data);

	return (
		<MealForm
			title="Create a new Meal"
			buttonText="Create"
			schema={schema}
			onSubmit={handleCreate}
		/>
	);
};

const mapDispatchToProps = dispatch => ({
	createMeal: (id, data) => dispatch(createMeal(id, data)),
});

export default connect(null, mapDispatchToProps)(CreateMealScreen);
