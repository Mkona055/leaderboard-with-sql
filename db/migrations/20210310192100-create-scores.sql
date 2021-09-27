CREATE SEQUENCE scores_id_seq;
CREATE TABLE scores(
  event_id int,
  athlete_id int,
  id int DEFAULT nextval('scores_id_seq'),
  identifier varchar(100) NOT NULL DEFAULT md5(random()::text),
  created timestamp NOT NULL  DEFAULT NOW(),
  modified timestamp NOT NULL  DEFAULT NOW(),
  number_reps int,
  finish_time time,
  best_set_time time,
  PRIMARY KEY (event_id,athlete_id),
  FOREIGN KEY (event_id) references events(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (athlete_id) references athlete(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  UNIQUE (identifier)
);
