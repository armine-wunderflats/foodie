import React, { useEffect, useState, useMemo } from 'react';
import { Link, useParams } from 'react-router-dom';
import { Button, Icon } from 'semantic-ui-react';
import { connect } from 'react-redux';

import { getCurrentUser } from '../../redux/ducks/user';
import { getRestaurantById } from '../../redux/ducks/restaurant';
import Loader from '../../components/Loader';
import ShoppingCart from './ShoppingCart';
import RestaurantOptions from './RestaurantOptions';
import Meals from './Meals';
import constants from '../../constants';

const RestaurantScreen = props => {
	const { id } = useParams();
	const { user, restaurant, getRestaurantById, getCurrentUser } = props;
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
		!user && getCurrentUser();
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

	const isOwner = user?.is_owner;
	const isCustomer = user?.is_customer;

	const handleDeduct = itemId => {
		const index = cart.indexOf(itemId);
		cart.splice(index, 1);
		setCart([...cart]);
	};

	if (!restaurant) return <Loader />;

	return (
		<div id="restaurant_screen">
			<Link to="/">
				<Icon name="arrow left" size="large" className="floatLeft goBack" />
			</Link>
			<h1 className="pageTitle">{restaurant.name}</h1>
			<h2 className="darkBlue">{restaurant.food_type}</h2>
			<div className="container">
				<p>{restaurant.description}</p>
				{isCustomer && (
					<Button
						className="floatRight cart"
						disabled={cart.length < 1}
						onClick={() => setVisible(true)}
					>
						View Cart
						<Icon name="cart" size="large" />
					</Button>
				)}
				{isOwner && (
					<Button className="floatRight cart" onClick={() => setVisible(true)}>
						<Icon name="bars" size="large" />
					</Button>
				)}
				<Meals
					data={restaurant.meals}
					handleAdd={handleAdd}
					handleDeduct={handleDeduct}
					occurences={occurences}
					isCustomer={isCustomer}
					isOwner={isOwner}
				/>
			</div>
			{isCustomer && (
				<ShoppingCart
					cart={cart}
					cartItems={cartItems}
					visible={visible}
					setVisible={setVisible}
					occurences={occurences}
				/>
			)}
			{isOwner && (
				<RestaurantOptions
					visible={visible}
					setVisible={setVisible}
					restaurant={restaurant}
				/>
			)}
		</div>
	);
};

const mapStateToProps = state => ({
	restaurant: state.restaurant.restaurant,
	user: state.user.currentUser,
});

const mapDispatchToProps = dispatch => ({
	getCurrentUser: () => dispatch(getCurrentUser()),
	getRestaurantById: id => dispatch(getRestaurantById(id)),
});

export default connect(mapStateToProps, mapDispatchToProps)(RestaurantScreen);
