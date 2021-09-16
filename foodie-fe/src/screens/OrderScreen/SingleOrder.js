import React, { useEffect, useMemo } from 'react';
import { useParams } from 'react-router-dom';
import { connect } from 'react-redux';
import { Button, Icon } from 'semantic-ui-react';
import { Link } from 'react-router-dom';
import moment from 'moment';

import Loader from '../../components/Loader';
import { getCurrentUser } from '../../redux/ducks/user';
import { getOrderById, updateOrderStatus } from '../../redux/ducks/order';
import { numberToCash } from '../../helpers/numberHelper';
import constants from '../../constants';

const SingleOrder = props => {
	const {
		user,
		order,
		history,
		getCurrentUser,
		getOrderById,
		updateOrderStatus,
	} = props;
	const { id } = useParams();
	const isOwner = user?.is_owner;
	const isCustomer = user?.is_customer;
	const nextStatus = useMemo(() => {
		const statuses = Object.values(constants.orderStatus);
		console.log(statuses);
		if (order?.status === constants.orderStatus.PLACED)
			return isOwner
				? constants.orderStatus.PROCESSING
				: constants.orderStatus.CANCELED;

		const index = statuses.indexOf(order?.status);
		return statuses[index === statuses.length ? index : index + 1];
	}, [order, user]);

	const buttonText = useMemo(
		() =>
			nextStatus === constants.orderStatus.CANCELED
				? 'Cancel Order'
				: 'Mark as ' + nextStatus,
		[nextStatus]
	);
	const occurences = useMemo(
		() =>
			order?.meals?.reduce((acc, curr) => {
				return (
					acc[curr.id]
						? ++acc[curr.id].quantity
						: (acc[curr.id] = { item: curr, quantity: 1 }),
					acc
				);
			}, []),
		[order]
	);

	const canUpdateStatus = useMemo(() => {
		if (!order || !user) return false;
		switch (order.status) {
			case constants.orderStatus.PLACED:
				return true;
			case constants.orderStatus.CANCELED:
				return false;
			case constants.orderStatus.PROCESSING:
			case constants.orderStatus.EN_ROUTE:
				return isOwner;
			case constants.orderStatus.DELIVERED:
				return isCustomer;
			default:
				return false;
		}
	}, [order, user]);

	useEffect(() => {
		getOrderById(id);
		!user && getCurrentUser();
	}, []);

	if (!user || !order) return <Loader />;

	return (
		<div id="single_order_screen">
			<Icon
				name="arrow left"
				size="large"
				className="floatLeft goBack"
				onClick={() => history.goBack()}
			/>
			<h1 className="clear darkBlue">Order</h1>
			<div className="container alignLeft">
				<p className="orderInfo">
					{`Order Date: ${moment(order.created_at).format(
						'MMMM Do YYYY, h:mm:ss a'
					)}`}
				</p>
				<p className="extraInfo">Delivery to: {order.address}</p>
				{order.instructions && (
					<p className="extraInfo">
						Delivery instructions: {order.instructions}
					</p>
				)}
				<p className="orderInfo">Status: {order.status}</p>
				<div className="ui list">
					{occurences.map(meal => (
						<div className="item">
							<p className="mealInfo floatRight">Quantity: {meal.quantity}</p>
							<p className="mealInfo">{meal.item.name}</p>
							{meal.quantity > 1 && (
								<p className="extraInfo floatRight">
									Price: {numberToCash(meal.quantity * meal.item.price)}
								</p>
							)}
							<p className="extraInfo">
								Unit Price: {numberToCash(meal.item.price)}
							</p>
						</div>
					))}
				</div>
				<p className="orderInfo alightRight">
					Total Price: {numberToCash(order.total_price)}
				</p>
				{canUpdateStatus && (
					<div className="statusButton">
						<Button onClick={() => updateOrderStatus(order.id)} primary>
							{buttonText}
						</Button>
					</div>
				)}
			</div>
		</div>
	);
};

const mapStateToProps = state => ({
	user: state.user.currentUser,
	order: state.order.order,
});

const mapDispatchToProps = dispatch => ({
	getCurrentUser: () => dispatch(getCurrentUser()),
	updateOrderStatus: id => dispatch(updateOrderStatus(id)),
	getOrderById: id => dispatch(getOrderById(id)),
});

export default connect(mapStateToProps, mapDispatchToProps)(SingleOrder);
