import React, { useState, useRef, useEffect } from 'react';
import { connect } from 'react-redux';
import { Button, Icon, Modal, Header, Input, TextArea, FormField, Form } from 'semantic-ui-react';
import { useParams, useHistory } from 'react-router-dom';
import { createOrder } from '../../redux/ducks/order';

const OrderModal = ({ loading, submissionError, cart, createOrder }) => {
	const { id } = useParams();
	const history = useHistory();
	const [open, setOpen] = useState(false);
	const [form, setForm] = useState({
		address: '',
		instructions: '',
	});
	const [error, setError] = useState(false);
	const didMountRef = useRef(false);
	const handleChange = field => e => setForm({ ...form, [field]: e.target.value });

	const onSubmit = () => {
		if (form.address.trim() === '') return setError(true);
		setError(false);
		createOrder(id, { ...form, mealIds: cart });
	};

	useEffect(() => {
		if (!didMountRef.current) return (didMountRef.current = true);
		if (loading || submissionError) return;

		setOpen(false);
		history.push('/');
	}, [loading]);

	return (
		<Modal
			closeIcon
			open={open}
			trigger={<Button>Check Out</Button>}
			onClose={() => setOpen(false)}
			onOpen={() => setOpen(true)}>
			<Header icon="cart" content="Confirm Order" />
			<Modal.Content>
				<p>Please provide an address and instructions for the devlivery and confirm your order.</p>
				<Form className="ui form">
					<FormField>
						<label htmlFor="address" className="label">
							<span>Address</span>
						</label>
						<Input value={form.address} name="address" onChange={handleChange('address')} />
						{error && <div class="error">The address is required</div>}
					</FormField>
					<FormField>
						<label htmlFor="instructions" className="label">
							<span>Instructions</span>
						</label>
						<TextArea value={form.instructions} onChange={handleChange('instructions')} name="instructions" />
					</FormField>
				</Form>
			</Modal.Content>
			<Modal.Actions>
				<Button color="red" onClick={() => setOpen(false)}>
					<Icon name="remove" /> Cancel
				</Button>
				<Button type="submit" color="green" onClick={onSubmit}>
					<Icon name="checkmark" /> Submit
				</Button>
			</Modal.Actions>
		</Modal>
	);
};

const mapStateToProps = state => ({
	loading: state.order.loading,
	submissionError: state.order.error,
});

const mapDispatchToProps = dispatch => ({
	createOrder: (id, data) => dispatch(createOrder(id, data)),
});

export default connect(mapStateToProps, mapDispatchToProps)(OrderModal);
