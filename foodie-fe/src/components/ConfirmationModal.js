import React, { useState } from 'react';
import { Button, Icon, Modal, Header } from 'semantic-ui-react';

const ConfirmationModal = ({ buttonText, title, icon, content, onSubmit, trigger }) => {
	const [open, setOpen] = useState(false);
	const handleClick = () => {
		setOpen(false);
		onSubmit();
	};

	return (
		<Modal basic closeIcon open={open} trigger={trigger} onClose={() => setOpen(false)} onOpen={() => setOpen(true)}>
			<Header icon={icon} content={title} />
			<Modal.Content>
				<p>{content}</p>
			</Modal.Content>
			<Modal.Actions>
				<Button color="red" onClick={() => setOpen(false)}>
					<Icon name="remove" /> Cancel
				</Button>
				<Button type="submit" color="green" onClick={handleClick}>
					<Icon name="checkmark" /> {buttonText}
				</Button>
			</Modal.Actions>
		</Modal>
	);
};

export default ConfirmationModal;
