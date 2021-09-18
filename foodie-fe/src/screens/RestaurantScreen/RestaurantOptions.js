import React from 'react';
import { Link } from 'react-router-dom';
import { Sidebar, Menu, Icon } from 'semantic-ui-react';

const RestaurantOptions = ({ visible, setVisible, restaurant }) => {
	const { innerWidth: width } = window;

	return (
		<Sidebar
			as={Menu}
			animation="overlay"
			onHide={() => setVisible(false)}
			vertical
			inverted
			className="menuDrawer"
			direction="right"
			visible={visible}
			width={width > 600 ? 'wide' : 'thin'}
		>
			<Menu.Item
				as={Link}
				className="menuItem"
				to={`/restaurants/${restaurant.id}/edit`}
			>
				<Icon name="edit" size="large" />
				Edit Restaurant
			</Menu.Item>
			<Menu.Item
				to={`/restaurants/${restaurant.id}/meals/create`}
				as={Link}
				className="menuItem"
			>
				<Icon name="food" size="large" />
				Add Meal
			</Menu.Item>
			<Menu.Item
				as={Link}
				className="menuItem"
				to={`/restaurants/${restaurant.id}/orders`}
			>
				<Icon name="list" size="large" />
				View Orders
			</Menu.Item>
		</Sidebar>
	);
};

export default RestaurantOptions;
