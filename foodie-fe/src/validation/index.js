import React from 'react';
import classnames from 'classnames';
import { connect } from 'formik';
import { compose } from 'redux';
import styles from './styles.css';

const Validation = ({ children, name, showMessage, formik }) => {
	const { errors, touched, setFieldTouched, handleChange, handleBlur } = formik;
	return (
		<React.Fragment>
			{React.Children.map(children, child => {
				return React.cloneElement(child, {
					className: classnames(child.props.className, {
						[styles.invalid]: touched[name] && errors[name],
					}),
					name: name,
					id: name,
					onChange: (args, data) => {
						setFieldTouched(name, false);
						if (typeof child.props.onChange === 'function') {
							child.props.onChange(args, data);
						} else {
							handleChange(args);
						}
					},
					onBlur: args => {
						if (typeof child.props.onBlur === 'function') {
							child.props.onBlur(args);
						} else {
							handleBlur(args);
						}
					},
				});
			})}
			{showMessage && (
				<div className="error">
					{errors[name] && touched[name] ? errors[name] : ''}
				</div>
			)}
		</React.Fragment>
	);
};

export default compose(connect)(Validation);
