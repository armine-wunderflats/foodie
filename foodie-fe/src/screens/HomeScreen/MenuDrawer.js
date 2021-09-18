import React, { useEffect } from 'react';
import { connect } from 'react-redux';
import { Sidebar, Menu, Button, Icon } from 'semantic-ui-react';
import { Link } from 'react-router-dom';

import Loader from '../../components/Loader';
import { getCurrentUser } from '../../redux/ducks/user';
import { logout } from '../../redux/ducks/auth';

const MenuDrawer = props => {
	const { loading, visible, setVisible, user, getCurrentUser, logout } = props;
	useEffect(() => {
		!user && getCurrentUser();
	}, []);

	if (loading || !user) return <Loader />;

	const isOwner = user.is_owner;
	const isCustomer = user.is_customer;
	const { innerWidth: width } = window;

	return (
		<Sidebar
			as={Menu}
			animation="overlay"
			onHide={() => setVisible(false)}
			vertical
			inverted
			direction="right"
			visible={visible}
			width={width > 600 ? 'wide' : 'thin'}
			className="menuDrawer"
		>
			{isCustomer && (
				<Menu.Item as={Link} to="/orders" className="menuItem">
					<Icon name="list" size="large" />
					Orders
				</Menu.Item>
			)}
			{isOwner && (
				<Menu.Item as={Link} to="/restaurant" className="menuItem">
					<Icon name="food" size="large" />
					Add Restaurant
				</Menu.Item>
			)}
			<Button className="logout" primary onClick={logout}>
				Log Out
				<Icon name="sign-out" />
			</Button>
		</Sidebar>
	);
};

const mapStateToProps = state => ({
	loading: state.user.loading,
	user: state.user.currentUser,
});

const mapDispatchToProps = dispatch => ({
	getCurrentUser: () => dispatch(getCurrentUser()),
	logout: () => dispatch(logout()),
});

export default connect(mapStateToProps, mapDispatchToProps)(MenuDrawer);
