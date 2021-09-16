import React, { useEffect, useState, useCallback } from 'react';
import { connect } from 'react-redux';
import { Button, Icon, Input, Grid } from 'semantic-ui-react';
import { Link } from 'react-router-dom';
import Loader from '../../components/Loader';
import { getRestaurants } from '../../redux/ducks/restaurant';
import debounce from 'lodash.debounce';
import MenuDrawer from './MenuDrawer';

const Restaurants = ({ data }) => {
	const { innerWidth: width } = window;

	String.prototype.trunc = function (n = 250) {
		return this.substr(0, n - 1) + (this.length > n ? '...' : '');
	};

	return (
		<Grid columns={width > 500 ? 2 : 1}>
			{data.map(item => (
				<Grid.Column key={item.id}>
					<Button
						as={Link}
						className="itemContainer"
						to={`/restaurants/${item.id}`}
					>
						<h3 className="itemTitle">{item.name}</h3>
						<p className="itemSubtitle">{item.food_type}</p>
						<p>{item.description?.trunc()}</p>
					</Button>
				</Grid.Column>
			))}
		</Grid>
	);
};

const HomeScreen = props => {
	const { restaurantList, getRestaurants } = props;
	const [visible, setVisible] = useState(false);
	const debouncedgetRestaurants = useCallback(
		debounce(
			(current_page, filter) => getRestaurants(current_page, filter),
			500
		),
		[]
	);

	const handleChange = useCallback(event => {
		const filter = event.target.value;
		debouncedgetRestaurants(restaurantList?.current_page, filter);
	}, []);

	useEffect(() => getRestaurants(props.current_page), []);

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
				<Restaurants data={data} />
			</div>
			<div className="pagination">
				{current_page > 1 && (
					<Button
						secondary
						className="floatLeft"
						onClick={() => getRestaurants(current_page - 1)}
					>
						Previous
					</Button>
				)}
				{last_page != current_page && (
					<Button
						secondary
						className="floatRight"
						onClick={() => getRestaurants(current_page + 1)}
					>
						Next
					</Button>
				)}
			</div>
			<MenuDrawer visible={visible} setVisible={setVisible} />
		</div>
	);
};

const mapStateToProps = state => ({
	current_page: state.restaurant.current_page,
	restaurantList: state.restaurant.restaurantList,
});

const mapDispatchToProps = dispatch => ({
	getRestaurants: (page, filter) => dispatch(getRestaurants(page, filter)),
});

export default connect(mapStateToProps, mapDispatchToProps)(HomeScreen);
