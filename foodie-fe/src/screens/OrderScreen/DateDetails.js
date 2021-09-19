import React, { useState } from 'react';
import { Accordion, Icon } from 'semantic-ui-react';
import moment from 'moment';

const DateDetails = ({ order }) => {
	const [active, setActive] = useState(false);
	const formatDate = date => moment(date).format('MMMM Do YYYY, h:mm:ss a');

	return (
		<Accordion styled>
			<Accordion.Title active={active} index={0} onClick={() => setActive(!active)}>
				<Icon name="dropdown" />
				Order Processing Details
			</Accordion.Title>
			<Accordion.Content active={active}>
				<p className="extraInfo"> Placed on: {formatDate(order.placed_on)}</p>
				{order.canceled_on && <p className="extraInfo"> Canceled on: {formatDate(order.canceled_on)}</p>}
				{order.processing_on && <p className="extraInfo"> Processing on: {formatDate(order.processing_on)}</p>}
				{order.en_route_on && <p className="extraInfo"> En Route on: {formatDate(order.en_route_on)}</p>}
				{order.delivered_on && <p className="extraInfo"> Delivered on: {formatDate(order.delivered_on)}</p>}
				{order.received_on && <p className="extraInfo"> Received on: {formatDate(order.received_on)}</p>}
			</Accordion.Content>
		</Accordion>
	);
};

export default DateDetails;
