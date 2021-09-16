import React from 'react';
import { Button, Grid } from 'semantic-ui-react';
import { Link } from 'react-router-dom';

const Restaurants = ({ data, isOwner }) => {
	const { innerWidth: width } = window;

	String.prototype.trunc = function (n = 250) {
		return this.substr(0, n - 1) + (this.length > n ? '...' : '');
	};

	if (data.length < 1)
		return (
			<h3 className="emptyList">
				{isOwner
					? "You don't have any restaurants yet"
					: "There aren't any restaurants yet"}
			</h3>
		);

	return (
		<Grid columns={width > 500 ? 2 : 1}>
			{data.map(item => (
				<Grid.Column key={item.id}>
					<Button
						as={Link}
						className="itemContainer"
						to={`/restaurants/${item.id}`}
					>
						<h3 className="itemTitle">{item.name}</h3>
						<p className="itemSubtitle">{item.food_type}</p>
						<p>{item.description?.trunc()}</p>
					</Button>
				</Grid.Column>
			))}
		</Grid>
	);
};

export default Restaurants;
