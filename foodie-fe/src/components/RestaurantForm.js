import React, { useEffect, useState } from 'react';
import { connect } from 'react-redux';
import { Formik, Form } from 'formik';
import { Input, FormField, Button, TextArea, Icon } from 'semantic-ui-react';
import { useHistory } from 'react-router-dom';

import Loader from './Loader';
import Validation from '../validation';
import { Link } from 'react-router-dom';

const RestaurantForm = ({
	loading,
	restaurant,
	onSubmit,
	schema,
	title,
	buttonText,
	isEdit,
}) => {
	const history = useHistory();
	const [submitted, setSubmitted] = useState(false);
	useEffect(() => {
		if (!restaurant || !submitted) return;

		history.push(`/restaurants/${restaurant.id}`);
	}, [restaurant]);

	const handleSubmit = data => {
		setSubmitted(true);
		onSubmit(data);
	};

	if (!restaurant && isEdit) return <Loader loading />;

	return (
		<div id="restaurant_form">
			<Loader loading={loading} />
			<Link to="/">
				<Icon name="arrow left" size="large" className="floatLeft goBack" />
			</Link>
			<h1 className="darkBlue">{title}</h1>
			<div className="container">
				<Formik
					initialValues={{
						name: isEdit ? restaurant?.name : '',
						food_type: isEdit ? restaurant?.food_type : '',
						description: isEdit ? restaurant?.description || '' : '',
					}}
					validationSchema={schema}
					onSubmit={handleSubmit}
					render={props => {
						const { values } = props;

						return (
							<Form className="ui form">
								<div className="container">
									<div>
										<FormField>
											<label htmlFor="name" className="label">
												<span>Restaurant Name</span>
											</label>
											<Validation name="name" showMessage={true}>
												<Input value={values.name} name="name" />
											</Validation>
										</FormField>
										<FormField>
											<label htmlFor="food_type" className="label">
												<span>Food Type</span>
											</label>
											<Validation name="food_type" showMessage={true}>
												<Input value={values.food_type} name="food_type" />
											</Validation>
										</FormField>
										<FormField>
											<label htmlFor="description" className="label">
												<span>Description</span>
											</label>
											<Validation name="description" showMessage={true}>
												<TextArea
													value={values.description}
													name="description"
												/>
											</Validation>
										</FormField>
									</div>
									<Button type="submit" primary onSubmit={props.onSubmit}>
										{buttonText}
									</Button>
								</div>
							</Form>
						);
					}}
				/>
			</div>
		</div>
	);
};

const mapStateToProps = state => ({
	loading: state.restaurant.loading,
	restaurant: state.restaurant.restaurant,
});

export default connect(mapStateToProps)(RestaurantForm);
