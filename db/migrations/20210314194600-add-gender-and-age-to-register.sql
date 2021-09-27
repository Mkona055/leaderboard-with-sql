BEGIN;
ALTER TABLE register
ADD gender varchar(2) CHECK (gender in ('M','F'));

UPDATE register
SET gender = athlete.sex
FROM athlete
WHERE athlete.id = register.athlete_id;
COMMIT;
