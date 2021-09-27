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
