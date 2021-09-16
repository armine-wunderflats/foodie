import React, { useEffect, useState, useMemo } from 'react';
import { useParams } from 'react-router-dom';
import { Button, Icon } from 'semantic-ui-react';
import { connect } from 'react-redux';
import Loader from '../../components/Loader';

import { getRestaurantById } from '../../redux/ducks/restaurant';
import constants from '../../constants';
import Meals from './Meals';
import ShoppingCart from './ShoppingCart';

const RestaurantScreen = props => {
	const { id } = useParams();
	const { restaurant, history, getRestaurantById } = props;
	const [visible, setVisible] = useState(false);
	const [cartItems, setCartItems] = useState([]);
	const [cart, setCart] = useState(
		JSON.parse(localStorage.getItem(constants.shoppingCart + id)) || []
	);
	const occurences = useMemo(
		() =>
			cart.reduce((acc, curr) => {
				return acc[curr] ? ++acc[curr] : (acc[curr] = 1), acc;
			}, {}),
		[cart]
	);

	useEffect(() => {
		getRestaurantById(id);
	}, []);

	useEffect(() => {
		localStorage.setItem(constants.shoppingCart + id, JSON.stringify(cart));
	}, [cart]);

	useEffect(() => {
		setCartItems(restaurant?.meals?.filter(e => cart.includes(e.id)));
	}, [cart, restaurant]);

	const handleAdd = itemId => {
		const newCart = [...cart, itemId];
		setCart(newCart);
	};

	const handleDeduct = itemId => {
		const index = cart.indexOf(itemId);
		cart.splice(index, 1);
		setCart([...cart]);
	};

	if (!restaurant) return <Loader />;

	return (
		<div id="restaurant_screen">
			<Icon
				name="arrow left"
				size="large"
				className="floatLeft goBack"
				onClick={() => history.goBack()}
			/>
			<h1 className="darkBlue">{restaurant.name}</h1>
			<h2 className="darkBlue">{restaurant.food_type}</h2>
			<div className="container">
				<p>{restaurant.description}</p>
				<Button
					className="floatRight cart"
					disabled={cart.length < 1}
					onClick={() => setVisible(true)}
				>
					View Cart
					<Icon name="cart" size="large" />
				</Button>
				<Meals
					data={restaurant.meals}
					handleAdd={handleAdd}
					handleDeduct={handleDeduct}
					occurences={occurences}
				/>
			</div>
			<ShoppingCart
				cart={cart}
				cartItems={cartItems}
				visible={visible}
				setVisible={setVisible}
				occurences={occurences}
			/>
		</div>
	);
};

const mapStateToProps = state => ({
	restaurant: state.restaurant.restaurant,
});

const mapDispatchToProps = dispatch => ({
	getRestaurantById: id => dispatch(getRestaurantById(id)),
});

export default connect(mapStateToProps, mapDispatchToProps)(RestaurantScreen);
