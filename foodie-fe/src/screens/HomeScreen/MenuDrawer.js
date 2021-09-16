import React, { useMemo, useEffect } from 'react';
import { connect } from 'react-redux';
import { Sidebar, Menu, Button, Icon } from 'semantic-ui-react';
import { Link } from 'react-router-dom';
import Loader from '../../components/Loader';

import { getCurrentUser } from '../../redux/ducks/user';
import { clearAuthentication } from '../../redux/ducks/auth';

const MenuDrawer = props => {
	const {
		loading,
		visible,
		setVisible,
		user,
		getCurrentUser,
		clearAuthentication,
	} = props;
	useEffect(() => {
		!user && getCurrentUser();
	}, []);

	if (loading || !user) return <Loader />;

	const isOwner = user.is_owner;
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
			<Menu.Item as={Link} to="/orders" className="menuItem">
				<Icon name="list" size="large" />
				Orders
			</Menu.Item>
			<Button className="logout" primary onClick={clearAuthentication}>
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
	clearAuthentication: () => dispatch(clearAuthentication()),
});

export default connect(mapStateToProps, mapDispatchToProps)(MenuDrawer);
