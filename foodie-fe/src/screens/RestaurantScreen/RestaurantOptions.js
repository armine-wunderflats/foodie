import React from 'react';
import { connect } from 'react-redux';
import { useHistory, Link } from 'react-router-dom';
import { Sidebar, Menu, Icon } from 'semantic-ui-react';

import { deleteRestaurantById } from '../../redux/ducks/restaurant';
import ConfirmationModal from '../../components/ConfirmationModal';

const RestaurantOptions = ({ visible, setVisible, restaurant, deleteRestaurantById }) => {
	const { innerWidth: width } = window;
	const history = useHistory();
	const handleDelete = () => {
		deleteRestaurantById(restaurant.id);
		history.push('/');
	};

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
			width={width > 600 ? 'wide' : 'thin'}>
			<Menu.Item to={`/restaurants/${restaurant.id}/meals/create`} as={Link} className="menuItem">
				<Icon name="food" size="large" />
				Add Meal
			</Menu.Item>
			<Menu.Item as={Link} className="menuItem" to={`/restaurants/${restaurant.id}/orders`}>
				<Icon name="list" size="large" />
				View Orders
			</Menu.Item>
			<Menu.Item as={Link} className="menuItem" to={`/restaurants/${restaurant.id}/edit`}>
				<Icon name="edit" size="large" />
				Edit Restaurant
			</Menu.Item>
			<ConfirmationModal
				title="Delete Restaurant"
				content={`Are you sure you want to delete ${restaurant.name}? This action is irreversible and all your data will be lost.`}
				buttonText="Delete"
				onSubmit={handleDelete}
				icon="trash"
				trigger={
					<Menu.Item className="menuItem">
						<Icon name="trash" size="large" />
						Delete Restaurant
					</Menu.Item>
				}
			/>
		</Sidebar>
	);
};

const mapStateToProps = state => ({
	loading: state.restaurant.loading,
});

const mapDispatchToProps = dispatch => ({
	deleteRestaurantById: id => dispatch(deleteRestaurantById(id)),
});

export default connect(mapStateToProps, mapDispatchToProps)(RestaurantOptions);
