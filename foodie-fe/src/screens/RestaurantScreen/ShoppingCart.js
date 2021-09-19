import React, { useMemo } from 'react';
import { Sidebar, Menu } from 'semantic-ui-react';
import { numberToCash } from '../../helpers/numberHelper';
import ConfirmationModal from './ConfirmationModal';

const ShoppingCart = ({ cart, cartItems, occurences, visible, setVisible }) => {
	const totalPrice = useMemo(() => cartItems?.reduce((a, b) => a + b.price * occurences[b.id], 0), [cartItems]);
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
			width={width > 600 ? 'wide' : 'thin'}>
			{cartItems?.map(item => (
				<Menu.Item>
					<h3>{item.name}</h3>
					<p>Quantity: {occurences[item.id]}</p>
					<p>Unit Price: {numberToCash(item.price)}</p>
				</Menu.Item>
			))}
			<Menu.Item>
				<h3>Total Price: {numberToCash(totalPrice)}</h3>
				<ConfirmationModal cart={cart} />
			</Menu.Item>
		</Sidebar>
	);
};

export default ShoppingCart;
