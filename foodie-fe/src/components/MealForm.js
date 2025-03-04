import React, { useEffect, useState } from 'react';
import { connect } from 'react-redux';
import { Formik, Form } from 'formik';
import { Input, FormField, Button, TextArea, Icon, Label } from 'semantic-ui-react';
import { useHistory, Link } from 'react-router-dom';
import { useParams } from 'react-router';

import Loader from './Loader';
import Validation from '../validation';
import ConfirmationModal from './ConfirmationModal';
import { deleteMealById } from '../redux/ducks/meal';

const MealForm = ({ loading, meal, onSubmit, schema, title, buttonText, isEdit, deleteMealById }) => {
	const history = useHistory();
	const [submitted, setSubmitted] = useState(false);
	const { id } = useParams();
	useEffect(() => {
		if (!meal || !submitted) return;

		history.push(`/restaurants/${id}`);
	}, [meal]);

	const handleSubmit = data => {
		setSubmitted(true);
		onSubmit(data);
	};

	const handleDelete = () => {
		deleteMealById(meal.id);
		history.push(`/restaurants/${id}`);
	};

	if (!meal && isEdit) return <Loader loading />;

	return (
		<div id="meal_form">
			<Loader loading={loading} />
			<Link to={`/restaurants/${id}`}>
				<Icon name="arrow left" size="large" className="floatLeft goBack" />
			</Link>
			<h1 className="pageTitle">{title}</h1>
			<div className="container">
				<Formik
					initialValues={{
						name: isEdit ? meal?.name : '',
						price: isEdit ? meal?.price : undefined,
						description: isEdit ? meal?.description || '' : '',
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
												<span>Meal Name</span>
											</label>
											<Validation name="name" showMessage={true}>
												<Input value={values.name} name="name" />
											</Validation>
										</FormField>
										<FormField>
											<label htmlFor="price" className="label">
												<span>Price</span>
											</label>
											<Validation name="price" showMessage={true}>
												<Input labelPosition="right" value={values.price} name="price" type="number">
													<Label basic>$</Label> <input />
												</Input>
											</Validation>
										</FormField>
										<FormField>
											<label htmlFor="description" className="label">
												<span>Description</span>
											</label>
											<Validation name="description" showMessage={true}>
												<TextArea value={values.description} name="description" />
											</Validation>
										</FormField>
									</div>
									{isEdit && (
										<ConfirmationModal
											title="Delete Meal"
											content={`Are you sure you want to delete ${meal.name}? This action is irreversible and all your data will be lost.`}
											buttonText="Delete"
											onSubmit={handleDelete}
											icon="trash"
											trigger={
												<Button type="button" secondary>
													Delete
												</Button>
											}
										/>
									)}
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
	loading: state.meal.loading,
	meal: state.meal.meal,
});

const mapDispatchToProps = dispatch => ({
	deleteMealById: id => dispatch(deleteMealById(id)),
});

export default connect(mapStateToProps, mapDispatchToProps)(MealForm);
