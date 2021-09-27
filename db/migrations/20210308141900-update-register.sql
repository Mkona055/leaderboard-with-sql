ALTER TABLE register
ADD identifier varchar(100),
ADD created timestamp,
ADD modified timestamp,
ADD age int,
ADD gender varchar(100);

ALTER TABLE register
RENAME COLUMN register_id TO id;
BEGIN;
  ALTER TABLE register ALTER COLUMN created SET DEFAULT NOW();
  ALTER TABLE register ALTER COLUMN modified SET DEFAULT NOW();
  UPDATE register SET created = NOW() WHERE created IS NULL;
  UPDATE register SET modified = created WHERE modified IS NULL;
  ALTER TABLE register ALTER COLUMN created SET NOT NULL;
COMMIT;

BEGIN;
  UPDATE register SET identifier = md5(random()::text) WHERE identifier IS NULL;
  ALTER TABLE register
  ALTER COLUMN identifier
  SET DEFAULT md5(random()::text);
  ALTER TABLE register ADD CONSTRAINT register_identifier_key UNIQUE (identifier);
COMMIT;

BEGIN;
  CREATE SEQUENCE register_id_seq;
  SELECT setval('register_id_seq', coalesce(max(id), 0) + 1, false) FROM register;
  ALTER TABLE register ALTER COLUMN id SET DEFAULT nextval('register_id_seq');
COMMIT;
