import React from 'react';
import { Button, Grid } from 'semantic-ui-react';
import { numberToCash } from '../../helpers/numberHelper';

const Meals = ({ data, occurences, handleAdd, handleDeduct, isCustomer }) => {
	const { innerWidth: width } = window;
	const AddToCartButtons = ({ item }) => {
		if (!isCustomer) return <></>;

		const isAdded = occurences[item.id] > 0;
		return (
			<>
				{isAdded && <p>Number of items in cart: {occurences[item.id]}</p>}
				<Button
					color={isAdded ? 'green' : 'blue'}
					to={`/restaurants/${item.id}`}
					onClick={() => handleAdd(item.id)}
				>
					{isAdded ? 'Add again' : 'Add To Cart'}
				</Button>
				{isAdded && (
					<Button
						secondary
						to={`/restaurants/${item.id}`}
						onClick={() => handleDeduct(item.id)}
					>
						Deduct from Cart
					</Button>
				)}
			</>
		);
	};

	return (
		<Grid columns={width > 500 ? 2 : 1} className="clear">
			{!data ||
				(data.length < 1 && (
					<h3 className="emptyList">There aren't any meals yet</h3>
				))}
			{data?.map(item => {
				return (
					<Grid.Column key={item.id}>
						<div className="itemContainer">
							<h3 className="itemTitle">{item.name}</h3>
							<p>{item.description}</p>
							<p className="itemSubtitle">{numberToCash(item.price)}</p>
							<AddToCartButtons item={item} />
						</div>
					</Grid.Column>
				);
			})}
		</Grid>
	);
};

export default Meals;
