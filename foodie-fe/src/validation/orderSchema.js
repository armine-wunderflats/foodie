import * as Yup from 'yup';

const orderSchema = Yup.object().shape({
	address: Yup.string().required('The address is required'),
});

export default orderSchema;
