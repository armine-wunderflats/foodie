import React, { useEffect } from 'react';
import { connect } from 'react-redux';
import { useParams } from 'react-router';

import schema from '../../validation/mealSchema';
import { updateMeal, getMealById } from '../../redux/ducks/meal';
import MealForm from '../../components/MealForm';

const EditMealScreen = ({ updateMeal, getMealById }) => {
	const { mealId } = useParams();
	const handleEdit = data => updateMeal(mealId, data);

	useEffect(() => {
		getMealById(mealId);
	}, []);

	return (
		<MealForm
			title="Update Meal"
			buttonText="Update"
			schema={schema}
			onSubmit={handleEdit}
			isEdit
		/>
	);
};

const mapDispatchToProps = dispatch => ({
	getMealById: id => dispatch(getMealById(id)),
	updateMeal: (id, data) => dispatch(updateMeal(id, data)),
});

export default connect(null, mapDispatchToProps)(EditMealScreen);
