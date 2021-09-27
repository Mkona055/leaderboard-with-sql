BEGIN;
CREATE TYPE scorebase AS ENUM ('Time ASC', 'Time DESC', 'Count ASC','Count DESC' );

CREATE SEQUENCE athletes_id_seq;
CREATE TABLE athlete (
  id int DEFAULT nextval('athletes_id_seq'),
  identifier varchar(100) NOT NULL DEFAULT md5(random()::text),
  created timestamp NOT NULL DEFAULT NOW(),
  modified timestamp NOT NULL DEFAULT NOW(),
  name varchar(1000),
  date_of_birth date,
  sex varchar(2) CHECK (sex in ('M','F')),
  email varchar(1000),
  nationality varchar (100),
  PRIMARY KEY (id),
  UNIQUE (identifier)
);
CREATE SEQUENCE partners_id_seq;
CREATE TABLE partners(
  id int DEFAULT nextval('partners_id_seq'),
  identifier varchar(100) NOT NULL DEFAULT md5(random()::text),
  created timestamp NOT NULL  DEFAULT NOW(),
  modified timestamp NOT NULL  DEFAULT NOW(),
  company_name varchar(1000) NOT NULL,
  address varchar(1000),
  city varchar(1000),
  representative varchar(1000),
  email varchar(1000),
  phone_number bigint,
  PRIMARY KEY (id),
  UNIQUE (identifier)
);
CREATE SEQUENCE competitions_id_seq;
CREATE TABLE competitions(
  id int DEFAULT nextval('competitions_id_seq'),
  partner_id int NOT NULL,
  identifier varchar(100) NOT NULL DEFAULT md5(random()::text),
  created timestamp NOT NULL DEFAULT NOW(),
  modified timestamp NOT NULL DEFAULT NOW(),
  name varchar(100),
  venue varchar (100),
  compet_year int,
  start_date date,
  end_date date,
  start_time time,
  max_athlete int,
  number_events int,
  representative varchar(1000),
  email varchar(1000),
  phone_number bigint,
  PRIMARY KEY(id),
  FOREIGN KEY(partner_id) references partners(id)
  	ON DELETE CASCADE
  	ON UPDATE CASCADE,
  UNIQUE (identifier)
);
CREATE SEQUENCE registrations_id_seq;
CREATE TABLE register(
  id int DEFAULT nextval('registrations_id_seq'),
  identifier varchar(100) NOT NULL DEFAULT md5(random()::text),
  created timestamp NOT NULL DEFAULT NOW(),
  modified timestamp NOT NULL DEFAULT NOW(),
  athlete_id int NOT NULL,
  competition_id int NOT NULL,
  gender varchar(2) CHECK (gender in ('M','F')),
  UNIQUE (identifier),
  PRIMARY KEY(competition_id,athlete_id),
  FOREIGN KEY(competition_id) references competitions(id)
  	ON DELETE CASCADE
  	ON UPDATE CASCADE,
  FOREIGN KEY(athlete_id) references athlete(id)
	ON DELETE CASCADE
  	ON UPDATE CASCADE
);

CREATE SEQUENCE events_id_seq;
CREATE TABLE events(
   id int DEFAULT nextval('events_id_seq'),
   identifier varchar(100) NOT NULL DEFAULT md5(random()::text),
   created timestamp NOT NULL  DEFAULT NOW(),
   modified timestamp NOT NULL  DEFAULT NOW(),
   event_date date,
   name varchar(1000),
   primary_score scorebase NOT NULL,
   primary_score_tb scorebase,
   time_cap scorebase,
   time_cap_tb scorebase,
   competition_id int NOT NULL,
   PRIMARY KEY (id),
   FOREIGN KEY (competition_id) references competitions(id)
       ON DELETE CASCADE
       ON UPDATE CASCADE,
   UNIQUE (identifier)
 );
CREATE SEQUENCE scores_id_seq;
CREATE TABLE scores(
  event_id int NOT NULL,
  athlete_id int NOT NULL,
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
CREATE VIEW competitions_view (competition,c_identifier,venue,start_date,end_date,start_time,max_athlete,number_events,representative,
  email,phone_number,company_name,p_identifier)AS 
(SELECT competitions.name as competition,competitions.identifier as c_identifier, venue,start_date,end_date,start_time,max_athlete,number_events,
competitions.representative,competitions.email,competitions.phone_number,company_name,partners.identifier as p_identifier
  FROM competitions
  JOIN partners ON partners.id = competitions.partner_id);

CREATE VIEW partners_competition_view(partner_id,c_identifier,p_identifier, name,venue,start_time,start_date,end_date,
  number_events,max_athlete,email,phone_number) as
  (SELECT partner_id, competitions.identifier as c_identifier,partners.identifier as p_identifier, competitions.name as name,venue,start_time,start_date,
  end_date,number_events,max_athlete,
  competitions.email as email, competitions.phone_number as phone_number 
  FROM partners JOIN competitions ON competitions.partner_id = partners.id);
  COMMIT;