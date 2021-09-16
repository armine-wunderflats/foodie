export const numberToCash = (num = 0) => {
	return (
		'$' +
		num
			.toFixed(2)
			.toString()
			.replace(/\B(?=(\d{3})+(?!\d))/g, ',')
	);
};
