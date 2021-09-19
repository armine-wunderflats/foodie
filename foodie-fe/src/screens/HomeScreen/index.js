import React, { useEffect, useState, useCallback } from 'react';
import { connect } from 'react-redux';
import { Button, Icon, Input } from 'semantic-ui-react';
import debounce from 'lodash.debounce';

import Loader from '../../components/Loader';
import MenuDrawer from './MenuDrawer';
import Restaurants from './Restaurants';
import { getRestaurants, getOwnerRestaurants } from '../../redux/ducks/restaurant';
import { getCurrentUser } from '../../redux/ducks/user';

const HomeScreen = props => {
	const { restaurantList, getRestaurants, getOwnerRestaurants, user, getCurrentUser } = props;
	const [visible, setVisible] = useState(false);
	const debouncedgetRestaurants = useCallback(
		debounce(
			(current_page, filter) => (user.is_owner ? getOwnerRestaurants() : getRestaurants(current_page, filter)),
			500
		),
		[user]
	);

	const handleChange = useCallback(event => {
		const filter = event.target.value;
		debouncedgetRestaurants(restaurantList?.current_page, filter);
	}, []);

	useEffect(() => {
		getCurrentUser();
	}, []);

	useEffect(() => {
		if (!user) return;

		user.is_owner ? getOwnerRestaurants() : getRestaurants(props.current_page);
	}, [user]);

	if (!restaurantList || !restaurantList.data) return <Loader />;
	const { current_page, last_page, data } = restaurantList;

	return (
		<div id="home_screen">
			<h1 className="container darkBlue">
				Restaurants
				<Button className="profile" onClick={() => setVisible(true)}>
					<Icon className="icon" name="bars" size="large" />
				</Button>
			</h1>
			<div className="container">
				<Input icon placeholder="Search..." onChange={handleChange}>
					<input />
					<Icon name="search" />
				</Input>
			</div>
			<div className="container">
				<Restaurants data={data} isOwner={user?.is_owner} />
			</div>
			{!user?.is_owner && (
				<div className="pagination">
					{current_page > 1 && (
						<Button secondary className="floatLeft" onClick={() => getRestaurants(current_page - 1)}>
							Previous
						</Button>
					)}
					{last_page != current_page && (
						<Button secondary className="floatRight" onClick={() => getRestaurants(current_page + 1)}>
							Next
						</Button>
					)}
				</div>
			)}
			<MenuDrawer visible={visible} setVisible={setVisible} />
		</div>
	);
};

const mapStateToProps = state => ({
	user: state.user.currentUser,
	current_page: state.restaurant.current_page,
	restaurantList: state.restaurant.restaurantList,
});

const mapDispatchToProps = dispatch => ({
	getCurrentUser: () => dispatch(getCurrentUser()),
	getOwnerRestaurants: () => dispatch(getOwnerRestaurants()),
	getRestaurants: (page, filter) => dispatch(getRestaurants(page, filter)),
});

export default connect(mapStateToProps, mapDispatchToProps)(HomeScreen);
