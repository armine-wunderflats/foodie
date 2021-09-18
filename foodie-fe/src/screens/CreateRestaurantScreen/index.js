import React from 'react';
import { connect } from 'react-redux';
import schema from '../../validation/restaurantSchema';
import { createRestaurant } from '../../redux/ducks/restaurant';
import RestaurantForm from '../../components/RestaurantForm';

const CreateRestaurantScreen = ({ createRestaurant }) => {
	return (
		<RestaurantForm
			title="Create a new Restaurant"
			buttonText="Create"
			schema={schema}
			onSubmit={createRestaurant}
		/>
	);
};

const mapDispatchToProps = dispatch => ({
	createRestaurant: data => dispatch(createRestaurant(data)),
});

export default connect(null, mapDispatchToProps)(CreateRestaurantScreen);
