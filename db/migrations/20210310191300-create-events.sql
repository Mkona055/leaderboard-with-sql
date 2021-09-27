CREATE TYPE scorebase AS ENUM ('Time ASC', 'Time DESC', 'Count ASC','Count DESC' );
CREATE SEQUENCE events_id_seq;
CREATE TABLE events(
   id int DEFAULT nextval('events_id_seq'),
   identifier varchar(100) NOT NULL DEFAULT md5(random()::text),
   created timestamp NOT NULL  DEFAULT NOW(),
   modified timestamp NOT NULL  DEFAULT NOW(),
   event_date date,
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