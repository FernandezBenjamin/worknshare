CREATE DATABASE work_n_share;
USE work_n_share;

CREATE TABLE USERS(
  id_user INTEGER NOT NULL AUTO_INCREMENT,
  email VARCHAR(20) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  first_name VARCHAR(50) NOT NULL,
  pwd VARCHAR(255)NOT NULL,
  token CHAR(32) DEFAULT NULL,
  is_delete BOOLEAN DEFAULT FALSE,
  is_admin BOOLEAN DEFAULT FALSE,
  date_insert TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  date_update TIMESTAMP DEFAULT 0,
  is_ban BOOLEAN DEFAULT FALSE,
  why_ban VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY (id_user)
);

CREATE TABLE SITES(
  id_site INTEGER NOT NULL AUTO_INCREMENT,
  name_site VARCHAR(50) NOT NULL,
  PRIMARY KEY (id_site)
);

CREATE TABLE SUBSCRIPTIONS(
  id_subtions INTEGER NOT NULL AUTO_INCREMENT,
  name_subtions VARCHAR(50) NOT NULL,
  description TEXT NOT NULL,
  PRIMARY KEY (id_subtions)
);

CREATE TABLE SERVICES(
  id_service INTEGER NOT NULL AUTO_INCREMENT,
  name_subtions VARCHAR(50) NOT NULL,
  description TEXT NOT NULL,
  PRIMARY KEY (id_service)
);

CREATE TABLE SERVICES_SUBS(
  id_subtions INTEGER NOT NULL REFERENCES SUBSCRIPTIONS(id_subtions),
  id_service INTEGER NOT NULL REFERENCES SERVICES(id_service),
  PRIMARY KEY(id_subtions,id_service)
);

CREATE TABLE SERVICES_SITE(
  id_site INTEGER NOT NULL REFERENCES SITES(id_site),
  id_service INTEGER NOT NULL REFERENCES SERVICES(id_service),
  PRIMARY KEY(id_site,id_service)
);

CREATE TABLE HARDWARE(
  id_hard INTEGER NOT NULL AUTO_INCREMENT,
  id_site INTEGER NOT NULL REFERENCES SITES(id_site),
  quantity INTEGER NOT NULL,
  name_hard VARCHAR(50) NOT NULL,
  PRIMARY KEY (id_hard,id_site)
);

-- CREATE TABLE LIST_HARDWARE(
--   id_site INTEGER NOT NULL REFERENCES SITES(id_site),
--   id_hard INTEGER NOT NULL REFERENCES HARDWARE(id_hard),
--   PRIMARY KEY (id_site,id_hard)
-- );

CREATE TABLE LOANS(
  id_user INTEGER NOT NULL REFERENCES USERS(id_user),
  id_hard INTEGER NOT NULL REFERENCES HARDWARE(id_hard),
  date_loan TIMESTAMP NOT NULL,
  PRIMARY KEY (id_user,id_hard,date_loan)
);


CREATE TABLE PRICES(
  id_price INTEGER NOT NULL AUTO_INCREMENT,
  id_subtions INTEGER NOT NULL REFERENCES SUBSCRIPTIONS(id_subtions),
  price FLOAT NOT NULL,
  hours_min TIMESTAMP DEFAULT 0,
  hours_max TIMESTAMP DEFAULT 0,
  is_month BOOLEAN DEFAULT FALSE,
  is_commit BOOLEAN DEFAULT FALSE,
  nb_month INTEGER DEFAULT 0,
  PRIMARY KEY (id_price,id_subtions)
);

CREATE TABLE SUBSCRIBERS(
  id_user INTEGER NOT NULL REFERENCES USERS(id_user),
  id_subtions INTEGER NOT NULL REFERENCES SUBSCRIPTIONS(id_subtions),
  id_price INTEGER NOT NULL REFERENCES PRICES(id_price),
  is_commit BOOLEAN DEFAULT FALSE,
  date_end TIMESTAMP DEFAULT 0,
  PRIMARY KEY (id_user,id_subtions,id_price)
);

CREATE TABLE TIMETABLES(
  id_timetab INTEGER NOT NULL AUTO_INCREMENT,
  id_site INTEGER NOT NULL REFERENCES SITES(id_site),
  date_start INTEGER NOT NULL,
  date_end INTEGER NOT NULL,
  hours_start TIMESTAMP DEFAULT 0,
  hours_end TIMESTAMP DEFAULT 0,
  PRIMARY KEY(id_timetab,id_site)
);

CREATE TABLE ROOMS(
  id_room INTEGER NOT NULL AUTO_INCREMENT,
  id_site INTEGER NOT NULL REFERENCES SITES(id_site),
  type INTEGER,
  quantity INTEGER,
  PRIMARY KEY(id_room,id_site)
);

CREATE TABLE RESERVATIONS(
  id_reserve INTEGER NOT NULL AUTO_INCREMENT,
  id_user INTEGER NOT NULL REFERENCES USERS(id_user),
  id_room INTEGER NOT NULL REFERENCES ROOMS(id_room),
  date_reserve TIMESTAMP NOT NULL,
  PRIMARY KEY(id_reserve,id_user,id_room)
);

CREATE TABLE SERVICES_RESERVES(
  id_reserve INTEGER NOT NULL REFERENCES RESERVATIONS(id_reserve),
  id_service INTEGER NOT NULL REFERENCES SERVICES(id_service),
  PRIMARY KEY(id_reserve,id_service)
);
