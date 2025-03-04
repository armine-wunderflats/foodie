import React, { useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { connect } from 'react-redux';
import { Button, Icon } from 'semantic-ui-react';
import { Link } from 'react-router-dom';
import moment from 'moment';

import Loader from '../../components/Loader';
import { getCurrentUser } from '../../redux/ducks/user';
import { getUserOrders, getRestaurantOrders } from '../../redux/ducks/order';

const OrderScreen = props => {
	const { orders, loading, user, getCurrentUser, getUserOrders, getRestaurantOrders } = props;
	const { id } = useParams();

	useEffect(() => {
		!user && getCurrentUser();
	}, []);

	useEffect(() => {
		if (!user) return;

		if (user.is_customer) getUserOrders();
		else if (id && user.is_owner) getRestaurantOrders(id);
	}, [user, id]);

	if (loading || !user || !orders) return <Loader />;
	const backUrl = user.is_customer ? '/' : `/restaurants/${id}`;

	return (
		<div id="order_screen">
			<Link to={backUrl}>
				<Icon name="arrow left" size="large" className="floatLeft goBack" />
			</Link>
			<h1 className="clear darkBlue">Orders</h1>
			<div className="container">
				<div className="ui list">
					{orders.length < 1 && <h3 className="emptyList">You don't have any orders yet</h3>}
					{orders.map(order => (
						<div className="item">
							<Button as={Link} to={`/orders/${order.id}`}>
								<div className="floatRight">
									<Icon className="icon" name="angle right" size="large" />
								</div>
								<div className="flex">
									{user.is_owner ? order.customer_name : order.restaurant_name}
									<span>{moment(order.created_at).format('MMM Do YYYY, h:mm a')}</span>
								</div>
							</Button>
						</div>
					))}
				</div>
			</div>
		</div>
	);
};

const mapStateToProps = state => ({
	loading: state.user.loading,
	user: state.user.currentUser,
	orders: state.order.orderList,
});

const mapDispatchToProps = dispatch => ({
	getCurrentUser: () => dispatch(getCurrentUser()),
	getUserOrders: () => dispatch(getUserOrders()),
	getRestaurantOrders: id => dispatch(getRestaurantOrders(id)),
});

export default connect(mapStateToProps, mapDispatchToProps)(OrderScreen);
