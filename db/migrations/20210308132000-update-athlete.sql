ALTER TABLE athlete
ADD email varchar(1000);

ALTER TABLE athlete
ADD nationality varchar(100);

ALTER TABLE athlete
ALTER COLUMN name TYPE varchar(1000);

ALTER TABLE athlete
ALTER COLUMN identifier TYPE varchar(100);

ALTER TABLE athlete
RENAME COLUMN athlete_id TO id;

BEGIN;
  ALTER TABLE athlete ALTER COLUMN created SET DEFAULT NOW();
  ALTER TABLE athlete ALTER COLUMN modified SET DEFAULT NOW();
  UPDATE athlete SET created = NOW() WHERE created IS NULL;
  UPDATE athlete SET modified = created WHERE modified IS NULL;
  ALTER TABLE athlete ALTER COLUMN created SET NOT NULL;
COMMIT;

BEGIN;
  UPDATE athlete SET identifier = md5(random()::text) WHERE identifier IS NULL;
  ALTER TABLE athlete
  ALTER COLUMN identifier
  SET DEFAULT md5(random()::text);
  ALTER TABLE athlete ADD CONSTRAINT athlete_identifier_key UNIQUE (identifier);
COMMIT;

BEGIN;
  CREATE SEQUENCE athlete_id_seq;
  SELECT setval('athlete_id_seq', coalesce(max(id), 0) + 1, false) FROM athlete;
  ALTER TABLE athlete ALTER COLUMN id SET DEFAULT nextval('athlete_id_seq');
COMMIT;
