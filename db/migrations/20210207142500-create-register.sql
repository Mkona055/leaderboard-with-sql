CREATE TABLE register(
  competition_id int,
  athlete_id int,
  register_id int,
  PRIMARY KEY(competition_id,athlete_id),
  FOREIGN KEY(competition_id) references competitions(competition_id)
  	ON DELETE CASCADE
  	ON UPDATE CASCADE,
  FOREIGN KEY(athlete_id) references athlete(athlete_id)
	  ON DELETE CASCADE
  	ON UPDATE CASCADE
);
