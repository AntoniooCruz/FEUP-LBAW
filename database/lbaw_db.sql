-----------------------------------------
-- Drop old schmema
-----------------------------------------
DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS category CASCADE;
DROP TABLE IF EXISTS event CASCADE;
DROP TABLE IF EXISTS post CASCADE;
DROP TABLE IF EXISTS attend_event CASCADE;
DROP TABLE IF EXISTS business CASCADE;
DROP TABLE IF EXISTS personal CASCADE;
DROP TABLE IF EXISTS comment CASCADE;
DROP TABLE IF EXISTS file CASCADE;
DROP TABLE IF EXISTS follow CASCADE;
DROP TABLE IF EXISTS invite CASCADE;
DROP TABLE IF EXISTS report CASCADE;
DROP TABLE IF EXISTS poll CASCADE;
DROP TABLE IF EXISTS poll_option CASCADE;
DROP TABLE IF EXISTS report_event CASCADE;
DROP TABLE IF EXISTS report_post CASCADE;
DROP TABLE IF EXISTS report_user CASCADE;
DROP TABLE IF EXISTS ticket CASCADE;
DROP TABLE IF EXISTS vote_on_poll CASCADE;

DROP TYPE IF EXISTS verification_state CASCADE;
DROP TYPE IF EXISTS report_state CASCADE;
DROP TYPE IF EXISTS report_types CASCADE;
DROP TYPE IF EXISTS user_types CASCADE;

DROP FUNCTION IF EXISTS cant_get_tickets() CASCADE;
DROP FUNCTION IF EXISTS get_tickets_past_event() CASCADE;
DROP FUNCTION IF EXISTS get_multiple_tickets() CASCADE;
DROP FUNCTION IF EXISTS edit_past_event() CASCADE;
DROP FUNCTION IF EXISTS change_event_event() CASCADE;
DROP FUNCTION IF EXISTS business_follow() CASCADE;

DROP TRIGGER IF EXISTS cant_get_tickets ON ticket CASCADE;
DROP TRIGGER IF EXISTS get_tickets_past_event ON ticket CASCADE;
DROP TRIGGER IF EXISTS get_multiple_tickets ON ticket CASCADE;
DROP TRIGGER IF EXISTS edit_past_event ON event CASCADE;
DROP TRIGGER IF EXISTS change_event_event ON event CASCADE;
DROP TRIGGER IF EXISTS business_follow ON event CASCADE;


-----------------------------------------
-- Types
-----------------------------------------
CREATE TYPE verification_state AS ENUM ('Pending', 'Approved');

CREATE TYPE report_state AS ENUM ('Pending', 'Approved', 'Ignored');

CREATE TYPE report_types AS ENUM ('Post', 'Event', 'User') ;

CREATE TYPE user_types AS ENUM ('Admin', 'Personal', 'Business') ;


-----------------------------------------
-- Tables
-----------------------------------------
-- Table: users
CREATE TABLE users (
    id_user  SERIAL      PRIMARY KEY,
    username VARCHAR (20) UNIQUE
                          NOT NULL,
    email    VARCHAR      UNIQUE
                          NOT NULL,
    name     VARCHAR (30),
    password VARCHAR      NOT NULL,
    description VARCHAR (100),
    active BOOLEAN default(true),
    user_type user_types NOT NULL,
    is_admin BOOLEAN NOT NULL DEFAULT FALSE
);

-- Table: category
CREATE TABLE category (
    id_category SERIAL      PRIMARY KEY,
    name        VARCHAR (20) UNIQUE
                             NOT NULL
);


-- Table: event
CREATE TABLE event (
    id_event     SERIAL       PRIMARY KEY,
    title        VARCHAR (50)  NOT NULL,
    date_created TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    date         TIMESTAMP WITH TIME zone NOT NULL,
    location     VARCHAR (40),
    description  VARCHAR (100),
    price        REAL          NOT NULL
                               CONSTRAINT price_value CHECK (price >= 0),
    capacity     INTEGER       CONSTRAINT capacity_value CHECK (capacity > 0),
    isPrivate    BOOLEAN       NOT NULL,
    id_owner     INTEGER       REFERENCES users (id_user) ON DELETE CASCADE,
    id_category  INTEGER       REFERENCES category (id_category) ON DELETE CASCADE,
    city         VARCHAR (30),

    CONSTRAINT event_dates CHECK ("date" > date_created)
);


-- Table: post
CREATE TABLE post (
    id_post   SERIAL       PRIMARY KEY,
    date      DATE          NOT NULL
                            DEFAULT (now() ),
    text      VARCHAR (800),
    id_event  INTEGER       REFERENCES event (id_event) ON DELETE CASCADE
                            NOT NULL,
    id_author INTEGER       REFERENCES users (id_user) ON DELETE CASCADE
                            NOT NULL
);


-- Table: attend_event
CREATE TABLE attend_event (
    id_user INTEGER REFERENCES users (id_user) ON DELETE CASCADE,
    id_event  INTEGER REFERENCES event (id_event) ON DELETE CASCADE,
    PRIMARY KEY (
        id_user,
        id_event
    )
);


-- Table: business
CREATE TABLE business (
    id_user    INTEGER PRIMARY KEY
                         REFERENCES users (id_user) ON DELETE CASCADE,
    verification verification_state    DEFAULT ('Pending') 
                         NOT NULL,
    website      TEXT
);

-- Table: personal
CREATE TABLE personal (
    id_user INTEGER PRIMARY KEY
                    REFERENCES users (id_user) ON DELETE CASCADE
);


-- Table: comment
CREATE TABLE comment (
    id_comment        SERIAL      PRIMARY KEY,
    text              VARCHAR (500) NOT NULL,
    id_post           INTEGER      
                                   REFERENCES post (id_post) ON DELETE CASCADE,
    id_parent_comment INTEGER      REFERENCES comment (id_comment) ON DELETE CASCADE,
    id_author INTEGER NOT NULL,
    date      DATE          NOT NULL,
    CONSTRAINT type_comment CHECK ( (id_post IS NOT NULL) OR (id_parent_comment IS NOT NULL)) 
                                 
);


-- Table: file
CREATE TABLE file (
    id_file SERIAL PRIMARY KEY,
    name    VARCHAR NOT NULL,
    id_post INTEGER NOT NULL
                    REFERENCES post (id_post) ON DELETE CASCADE
);


-- Table: follow
CREATE TABLE follow (
    id_user1 INTEGER REFERENCES personal (id_user) ON DELETE CASCADE,
    id_user2 INTEGER REFERENCES users (id_user) ON DELETE CASCADE,
    PRIMARY KEY (
        id_user1,
        id_user2
    )
);


-- Table: invite
CREATE TABLE invite (
    id_inviter INTEGER REFERENCES personal (id_user) ON DELETE CASCADE,
    id_invitee INTEGER REFERENCES personal (id_user) ON DELETE CASCADE,
    id_event   INTEGER REFERENCES event (id_event) ON DELETE CASCADE,
    PRIMARY KEY (
        id_inviter,
        id_invitee,
        id_event
    )
);


-- Table: report
CREATE TABLE report (
    id_report SERIAL      PRIMARY KEY,
    reason    VARCHAR (300) NOT NULL,
    veridict  report_state DEFAULT ('Pending') 
                           NOT NULL,
    report_type report_types,
    id_admin INTEGER REFERENCES users (id_user) ON DELETE CASCADE
);


-- Table: poll
CREATE TABLE poll (
    id_poll SERIAL PRIMARY KEY,
    id_post INTEGER REFERENCES post (id_post) ON DELETE CASCADE
                    NOT NULL
);


-- Table: poll_option
CREATE TABLE poll_option (
    id_poll_option SERIAL      PRIMARY KEY,
    name           VARCHAR (20) NOT NULL,
    id_poll        INTEGER      REFERENCES poll (id_poll) ON DELETE CASCADE
                                NOT NULL
);


-- Table: report_event
CREATE TABLE report_event (
    id_report   INTEGER PRIMARY KEY
                        REFERENCES report (id_report) ON DELETE CASCADE,
    id_reporter INTEGER NOT NULL
                        REFERENCES users (id_user) ON DELETE CASCADE,
    id_event    INTEGER NOT NULL
                        REFERENCES event (id_event) ON DELETE CASCADE
);


-- Table: report_post
CREATE TABLE report_post (
    id_report   INTEGER PRIMARY KEY
                        REFERENCES report (id_report) ON DELETE CASCADE,
    id_reporter INTEGER NOT NULL
                        REFERENCES users (id_user) ON DELETE CASCADE,
    id_post     INTEGER REFERENCES post (id_post) ON DELETE CASCADE
                        NOT NULL
);


-- Table: report_user
CREATE TABLE report_user (
    id_report          INTEGER REFERENCES report (id_report) ON DELETE CASCADE
                               PRIMARY KEY,
    id_reporter        INTEGER REFERENCES users (id_user) ON DELETE CASCADE
                               NOT NULL,
    id_reported_user INTEGER REFERENCES users (id_user) ON DELETE CASCADE
                               NOT NULL
);


-- Table: ticket
CREATE TABLE ticket (
    token           SERIAL PRIMARY KEY,
    id_event        INTEGER REFERENCES event (id_event) ON DELETE CASCADE
                            NOT NULL,
    id_ticket_owner INTEGER REFERENCES personal (id_user) ON DELETE CASCADE
                            NOT NULL
);


-- Table: vote_on_poll
CREATE TABLE vote_on_poll (
    id_user        INTEGER REFERENCES users (id_user) ON DELETE CASCADE,
    id_poll         INTEGER REFERENCES poll (id_poll) ON DELETE CASCADE,
    id_poll_option INTEGER REFERENCES poll_option (id_poll_option) ON DELETE CASCADE,
    PRIMARY KEY (
        id_user,
        id_poll
    )
);


-----------------------------------------
-- INDEXES
-----------------------------------------


-----------------------------------------
-- TRIGGERS and UDFs
-----------------------------------------
--event organizers and business accounts can't buy tickets
    --procedure
CREATE OR REPLACE FUNCTION cant_get_tickets() RETURNS trigger AS $BODY$
BEGIN
  IF EXISTS ( SELECT * FROM event 
						  WHERE NEW.id_ticket_owner = event.id_owner
              AND New.id_event = event.id_event
						) THEN RAISE EXCEPTION 'An organizer cannot attend their own event';
  RETURN NEW;	          
	END IF;	
  IF EXISTS ( SELECT * FROM business
              WHERE business.id_user = NEW.id_ticket_owner
            ) THEN RAISE EXCEPTION 'Business accounts cannot purchase tickets';
  RETURN NEW;	          
  END IF;
  RETURN NEW;	  
END $BODY$
LANGUAGE plpgsql;

    --trigger
CREATE TRIGGER cant_get_tickets BEFORE INSERT OR UPDATE ON ticket
FOR EACH ROW
EXECUTE PROCEDURE cant_get_tickets();

--get ticket to past event
    --procedure
CREATE OR REPLACE FUNCTION get_tickets_past_event() RETURNS trigger AS $BODY$
BEGIN		
	IF EXISTS ( SELECT * FROM event
              WHERE event.id_event = NEW.id_event
              AND event.date <= now() 
            ) THEN RAISE EXCEPTION 'An user cannot get a ticket to a past event';
	END IF;	
  RETURN NEW;	  
END $BODY$
LANGUAGE plpgsql;

    --trigger
CREATE TRIGGER get_tickets_past_event BEFORE INSERT OR UPDATE ON ticket
FOR EACH ROW
EXECUTE PROCEDURE get_tickets_past_event();


--multiple tickets
    --procedure
CREATE OR REPLACE FUNCTION get_multiple_tickets() RETURNS trigger AS $BODY$
BEGIN		
	IF EXISTS ( SELECT * FROM ticket 
							WHERE NEW.id_ticket_owner = ticket.id_ticket_owner
              AND NEW.id_event = ticket.id_event
						) THEN RAISE EXCEPTION 'Only one ticket per user';
	END IF;
  RETURN NEW;			
END $BODY$
LANGUAGE plpgsql;

    --trigger
CREATE TRIGGER get_multiple_tickets BEFORE INSERT OR UPDATE ON ticket
FOR EACH ROW
EXECUTE PROCEDURE get_multiple_tickets();


--edit event info
    --procedure
CREATE OR REPLACE FUNCTION edit_past_event()
  RETURNS trigger AS $BODY$
BEGIN
  IF OLD.date >= now() THEN RAISE EXCEPTION 'Past events cannot be edited';
  END IF;
  RETURN NEW;
END $BODY$
LANGUAGE plpgsql;

    --trigger
CREATE TRIGGER edit_past_event BEFORE UPDATE ON event
FOR EACH ROW
EXECUTE PROCEDURE edit_past_event();


--change_event_event
    --procedure
CREATE OR REPLACE FUNCTION change_event_event()
  RETURNS trigger AS $BODY$
BEGIN
  IF NEW.price != OLD.price THEN RAISE EXCEPTION 'Once the event has been created, the ticket price cannot be changed';
  END IF;
  RETURN NEW;
END $BODY$
LANGUAGE plpgsql;

    --trigger
CREATE TRIGGER change_event_event BEFORE UPDATE ON event
FOR EACH ROW
EXECUTE PROCEDURE change_event_event();


--follow rules
    --procedure
CREATE OR REPLACE FUNCTION business_follow() RETURNS trigger AS $BODY$
BEGIN
  IF EXISTS ( SELECT * FROM business 
							WHERE NEW.id_user1 = business.id_user
						) THEN RAISE EXCEPTION 'Business accounts cannot';
	END IF;
  RETURN NEW;	
END $BODY$
LANGUAGE plpgsql;

    --trigger
CREATE TRIGGER business_follow BEFORE UPDATE ON event
FOR EACH ROW
EXECUTE PROCEDURE business_follow();
