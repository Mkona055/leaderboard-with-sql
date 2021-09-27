BEGIN;
ALTER TABLE athlete ADD CONSTRAINT athlete_sex_constraint
CHECK (sex in ('M','F'));
COMMIT;
