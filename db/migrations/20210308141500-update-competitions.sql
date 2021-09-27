ALTER TABLE competitions
ADD end_date date
ADD identifier varchar(100),
ADD created timestamp,
ADD modified timestamp,
ADD max_athlete int,
ADD number_events int,
ADD representative varchar(1000),
ADD email varchar(1000),
ADD phone_number bigint,
ADD compet_year int;

ALTER TABLE competitions
RENAME COLUMN competition_id TO id;

ALTER TABLE competitions
ALTER COLUMN competition_id SET NOT NULL;

ALTER TABLE competitions
ADD CONSTRAINT partner_id_fkey
FOREIGN KEY(partner_id) references partners(id)
ON DELETE CASCADE
ON UPDATE CASCADE;

BEGIN;
  ALTER TABLE competitions ALTER COLUMN created SET DEFAULT NOW();
  ALTER TABLE competitions ALTER COLUMN modified SET DEFAULT NOW();
  UPDATE competitions SET created = NOW() WHERE created IS NULL;
  UPDATE competitions SET modified = created WHERE modified IS NULL;
  ALTER TABLE competitions ALTER COLUMN created SET NOT NULL;
COMMIT;

BEGIN;
  UPDATE competitions SET identifier = md5(random()::text) WHERE identifier IS NULL;
  ALTER TABLE competitions
  ALTER COLUMN identifier
  SET DEFAULT md5(random()::text);
  ALTER TABLE competitions ADD CONSTRAINT competitions_identifier_key UNIQUE (identifier);
COMMIT;

BEGIN;
  CREATE SEQUENCE competitions_id_seq;
  SELECT setval('competitions_id_seq', coalesce(max(id), 0) + 1, false) FROM competitions;
  ALTER TABLE competitions ALTER COLUMN id SET DEFAULT nextval('competitions_id_seq');
COMMIT;
