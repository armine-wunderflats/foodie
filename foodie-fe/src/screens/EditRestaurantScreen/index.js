import React, { useEffect } from 'react';
import { connect } from 'react-redux';
import { useParams } from 'react-router-dom';

import schema from '../../validation/restaurantSchema';
import {
	updateRestaurant,
	getRestaurantById,
} from '../../redux/ducks/restaurant';
import RestaurantForm from '../../components/RestaurantForm';

const EditRestaurantScreen = ({ updateRestaurant, getRestaurantById }) => {
	const { id } = useParams();

	useEffect(() => {
		getRestaurantById(id);
	}, []);

	return (
		<RestaurantForm
			title="Edit the Restaurant"
			buttonText="Update"
			schema={schema}
			onSubmit={data => updateRestaurant(id, data)}
			isEdit
		/>
	);
};

const mapDispatchToProps = dispatch => ({
	getRestaurantById: id => dispatch(getRestaurantById(id)),
	updateRestaurant: (id, data) => dispatch(updateRestaurant(id, data)),
});

export default connect(null, mapDispatchToProps)(EditRestaurantScreen);
