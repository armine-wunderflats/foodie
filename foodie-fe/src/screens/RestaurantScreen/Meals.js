import React from 'react';
import { Button, Grid } from 'semantic-ui-react';
import { numberToCash } from '../../helpers/numberHelper';

const Meals = ({ data, occurences, handleAdd, handleDeduct }) => {
	const { innerWidth: width } = window;
	return (
		<Grid columns={width > 500 ? 2 : 1} className="clear">
			{data.map(item => {
				const isAdded = occurences[item.id] > 0;

				return (
					<Grid.Column key={item.id}>
						<div className="itemContainer">
							<h3 className="itemTitle">{item.name}</h3>
							<p>{item.description}</p>
							<p className="itemSubtitle">{numberToCash(item.price)}</p>
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
						</div>
					</Grid.Column>
				);
			})}
		</Grid>
	);
};

export default Meals;
