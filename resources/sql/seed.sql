-----------------------------------------
-- Drop old schmema
-----------------------------------------
DROP TYPE IF EXISTS verification_state CASCADE;
DROP TYPE IF EXISTS report_state CASCADE;
DROP TYPE IF EXISTS report_types CASCADE;
DROP TYPE IF EXISTS user_types CASCADE;
DROP TYPE IF EXISTS post_types CASCADE;

DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS category CASCADE;
DROP TABLE IF EXISTS event CASCADE;
DROP TABLE IF EXISTS post CASCADE;
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
DROP TABLE IF EXISTS password_resets CASCADE;


DROP FUNCTION IF EXISTS cant_get_tickets() CASCADE;
DROP FUNCTION IF EXISTS get_tickets_past_event() CASCADE;
DROP FUNCTION IF EXISTS get_multiple_tickets() CASCADE;
DROP FUNCTION IF EXISTS edit_past_event() CASCADE;
DROP FUNCTION IF EXISTS change_event_event() CASCADE;
DROP FUNCTION IF EXISTS business_follow() CASCADE;
DROP FUNCTION IF EXISTS full_event() CASCADE;
DROP FUNCTION IF EXISTS invite_to_private() CASCADE;

DROP TRIGGER IF EXISTS cant_get_tickets ON ticket CASCADE;
DROP TRIGGER IF EXISTS get_tickets_past_event ON ticket CASCADE;
DROP TRIGGER IF EXISTS get_multiple_tickets ON ticket CASCADE;
DROP TRIGGER IF EXISTS edit_past_event ON event CASCADE;
DROP TRIGGER IF EXISTS change_event_event ON event CASCADE;
DROP TRIGGER IF EXISTS business_follow ON event CASCADE;
DROP TRIGGER IF EXISTS full_event  ON ticket CASCADE;
DROP TRIGGER IF EXISTS invite_to_private  ON invite CASCADE;
DROP TRIGGER IF EXISTS search_idx ON event CASCADE;

DROP INDEX IF EXISTS event_creator CASCADE;
DROP INDEX IF EXISTS ticket_id_event CASCADE;
DROP INDEX IF EXISTS file_id_post CASCADE;
DROP INDEX IF EXISTS poll_id_post CASCADE;
DROP INDEX IF EXISTS post_id_author CASCADE;
DROP INDEX IF EXISTS comment_id_post CASCADE;
DROP INDEX IF EXISTS comment_id_author CASCADE;
DROP INDEX IF EXISTS ticket_id_author CASCADE;


-----------------------------------------
-- Types
-----------------------------------------
CREATE TYPE verification_state AS ENUM ('Pending', 'Approved');

CREATE TYPE report_state AS ENUM ('Pending', 'Approved', 'Ignored');

CREATE TYPE report_types AS ENUM ('Post', 'Event', 'User') ;

CREATE TYPE user_types AS ENUM ('Admin', 'Personal', 'Business') ;

CREATE TYPE post_types AS ENUM ('Poll', 'File', 'None');


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
    is_admin BOOLEAN NOT NULL DEFAULT FALSE,
    remember_token TEXT
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
    is_private    BOOLEAN       NOT NULL,
    id_owner     INTEGER       REFERENCES users (id_user) ON DELETE CASCADE,
    id_category  INTEGER       REFERENCES category (id_category) ON DELETE CASCADE,
    city         VARCHAR (30),
    search_tokens TSVECTOR,

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
                            NOT NULL,
    post_type post_types NOT NULL
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
                            NOT NULL,
    date_acquired     DATE          NOT NULL,
    checked_in BOOLEAN NOT NULL 
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

-- Table: password_resets
CREATE TABLE password_resets (
    email       TEXT PRIMARY KEY,
    token      TEXT,
    created_at TIMESTAMP WITH TIME zone
);


-----------------------------------------
-- INDEXES
-----------------------------------------

CREATE INDEX event_creator ON event USING btree (id_owner);
CREATE INDEX ticket_id_event ON ticket USING hash (id_event);
CREATE INDEX file_id_post ON file USING btree (id_post);
CREATE INDEX poll_id_post ON poll USING btree (id_post);
CREATE INDEX post_id_author ON post USING btree (id_author);
CREATE INDEX comment_id_post ON comment USING btree (id_post);
CREATE INDEX comment_id_author ON comment USING btree (id_author);
CREATE INDEX ticket_id_owner ON ticket USING btree (id_ticket_owner, id_event);
CREATE INDEX search_idx ON event USING GIST (to_tsvector('english', title || description)); 

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
CREATE OR REPLACE FUNCTION edit_past_event() RETURNS trigger AS $BODY$
BEGIN
  IF OLD.date >= now() THEN RAISE EXCEPTION 'Past events cannot be edited';
  END IF;
  RETURN NEW;
END $BODY$
LANGUAGE plpgsql;

    --trigger
--CREATE TRIGGER edit_past_event BEFORE UPDATE ON event
--FOR EACH ROW
--EXECUTE PROCEDURE edit_past_event();


--change_event_event
    --procedure
CREATE OR REPLACE FUNCTION change_event_event() RETURNS trigger AS $BODY$
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
CREATE TRIGGER business_follow BEFORE UPDATE ON follow
FOR EACH ROW
EXECUTE PROCEDURE business_follow();


CREATE OR REPLACE FUNCTION full_event() RETURNS trigger AS $BODY$
BEGIN
  IF New.id_event IN ( SELECT id_event
                        FROM (  SELECT event.id_event, capacity, count(*) AS occupancy
							    FROM event, ticket
							    WHERE event.id_event = ticket.id_event
							    GROUP BY event.id_event, capacity
			                ) AS lotation
                        WHERE occupancy >= capacity
				    ) THEN RAISE EXCEPTION 'Event is already at full capacity';
  END IF;
  RETURN NEW;	  
END $BODY$
LANGUAGE plpgsql;

    --trigger
CREATE TRIGGER full_event BEFORE INSERT OR UPDATE ON ticket
FOR EACH ROW
EXECUTE PROCEDURE full_event();  


--permissions to get ticket to event
    --procedure
CREATE OR REPLACE FUNCTION get_ticket_permissions() RETURNS TRIGGER AS $BODY$
BEGIN
  IF NEW.id_event NOT IN (SELECT event.id_event
						FROM event, invite
						WHERE event.is_private = 'true'
							AND event.id_event = invite.id_event
							AND invite.id_invitee = NEW.id_ticket_owner
					    UNION 
						SELECT event.id_event
						FROM event
						WHERE event.is_private = 'false') THEN RAISE EXCEPTION 'An user cannot attend a private event they were not invited to';
  END IF;
  RETURN NEW;	  
END $BODY$
LANGUAGE plpgsql;

    --trigger
CREATE TRIGGER get_ticket_permissions BEFORE INSERT OR UPDATE ON ticket
FOR EACH ROW
EXECUTE PROCEDURE get_ticket_permissions();  


--invitations permissions
    --procedure
CREATE OR REPLACE FUNCTION invite_to_private() RETURNS  TRIGGER AS $BODY$
BEGIN
  IF EXISTS ( SELECT * FROM event 
							WHERE NEW.id_event = event.id_event
							AND event.is_private = true
							AND event.id_owner != NEW.id_inviter
						) THEN RAISE EXCEPTION 'Only the organizer of a private event can invite people to it';
	END IF;
  RETURN NEW;	
END $BODY$
  LANGUAGE plpgsql;



    --trigger
CREATE TRIGGER invite_to_private BEFORE INSERT OR UPDATE ON invite
FOR EACH ROW
EXECUTE PROCEDURE invite_to_private();

--fulltext search event
    --procedure
CREATE OR REPLACE FUNCTION update_tsvector() RETURNS  TRIGGER AS $BODY$
BEGIN
  UPDATE event SET search_tokens = setweight(to_tsvector('english', NEW.title), 'A') || setweight(to_tsvector('english', NEW.description), 'B')
  WHERE id_event = NEW.id_event ;
  RETURN NEW;	
END $BODY$
  LANGUAGE plpgsql;

CREATE TRIGGER tsvectorupdate AFTER INSERT OR UPDATE OF title,description ON event
FOR EACH ROW
EXECUTE PROCEDURE update_tsvector();


-----------------------------------------
-- Populate database
-----------------------------------------

--users
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('ckinsett0', 'ckinsett0@edublogs.org', 'Corabel Kinsett', 'TSB0eROu', 'libero quis orci nullam molestie nibh in lectus pellentesque at', true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('mbettaney1', 'mbettaney1@dailymotion.com', 'Mollie Bettaney', 'FmXGkoBIGmn9', 'quam fringilla rhoncus mauris enim leo rhoncus sed vestibulum sit', true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('scrumbleholme2', 'scrumbleholme2@bing.com', 'Spence Crumbleholme', 'ZZtIKj5uC', 'cubilia curae nulla dapibus dolor vel est donec odio justo sollicitudin ut', true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('sthursby3', 'sthursby3@seesaa.net', 'Salomo Thursby', 'Y4cTlVlj3Z', 'lorem integer tincidunt ante vel ipsum praesent blandit lacinia erat vestibulum', true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('ktarver4', 'ktarver4@army.mil', 'Konrad Tarver', 'mW7vK9bs', 'sagittis nam congue risus semper porta volutpat quam pede lobortis ligula sit', true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('emanna5', 'emanna5@sina.com.cn', 'Eveleen Manna', 'vI7kN1BRi16', 'eget rutrum at lorem integer tincidunt ante vel ipsum praesent', true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('ghymor6', 'ghymor6@umich.edu', 'Gideon Hymor', '5ZHM8CPjR', 'placerat ante nulla justo a,liquam quis turpis eget elit sodales', true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('epavett7', 'epavett7@quantcast.com', 'Egon Pavett', 'rcg22aA', null, true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('ksilk8', 'ksilk8@tuttocitta.it', 'Kahlil Silk', 'o0Perg2iAzH', null, true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('dclouston9', 'dclouston9@istockphoto.com', 'Dru Clouston', 'eEKLhABcSu', 'aenean lectus pellentesque eget nunc donec quis orci eget orci vehicula condimentum', true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('corvissa', 'corvissa@macromedia.com', 'Clair Orviss', 'mXmbfC', 'volutpat quam pede lobortis ligula sit amet eleifend pede libero', true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('fbraderb', 'fbraderb@themeforest.net', 'Flossy Brader', 'coelqXfqaZ', null, true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('pleethemc', 'pleethemc@shinystat.com', 'Pavia Leethem', 'qNQ4hT', null, true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('hdyetd', 'hdyetd@nymag.com', 'Hephzibah Dyet', '3RgbtTKZpo', 'donec quis orci eget orci vehicula condimentum curabitur in libero ut', true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('cbassete', 'cbassete@bluehost.com', 'Carena Basset', 'FMeFH8sZo9a', 'morbi sem mauris laoreet ut rhoncus aliquet pulvinar sed nisl', true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('kfoulshamf', 'kfoulshamf@wikipedia.org', 'Krissie Foulsham', 'IR6yWweFxNy', null, true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('dleaningg', 'dleaningg@upenn.edu', 'Den Leaning', 'V4PDCs0', 'urna ut tellus nulla ut erat id mauris vulputate elementum nullam', false, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('einglebyh', 'einglebyh@newyorker.com', 'Euell Ingleby', 'hidGQI', null, true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('dspandleyi', 'dspandleyi@macromedia.com', 'Doralin Spandley', '580NEGW3T2Rc', 'posuere metus vitae ipsum aliquam non mauris morbi non lectus', true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('wgethinsj', 'wgethinsj@army.mil', 'Willem Gethins', 'aJ3N8nrJFzI', 'sit amet eleifend pede libero quis orci nullam molestie nibh in', true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('jstoodk', 'jstoodk@umn.edu', 'Joanie Stood', 'wAIXNLMhdS09', 'potenti cras in purus eu magna vulputate luctus cum sociis', true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('kgreatlandl', 'kgreatlandl@google.fr', 'Kara Greatland', 'USr5eIwtxV', 'nam congue risus semper porta volutpat quam pede lobortis ligula sit amet', true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('cwelberrym', 'cwelberrym@pbs.org', 'Chadd Welberry', 'fX7jl07f', null, true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('cbasilen', 'cbasilen@microsoft.com', 'Celia Basile', 'icEtUlFMz6', 'lectus vestibulum quam sapien varius ut blandit non interdum in', true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('ceateso', 'ceateso@icio.us', 'Corrine Eates', 'ebv2jtW7o5r', 'felis donec semper sapien a libero nam dui proin leo', true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('chargessp', 'chargessp@seesaa.net', 'Celia Hargess', '1JpDr6RVN', 'faucibus cursus urna ut tellus nulla ut erat id mauris vulputate', true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('amoreingq', 'amoreingq@discovery.com', 'Amby Moreing', '0F6kOFu7', 'quisque ut erat curabitur gravida nisi at nibh in hac', true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('acookmanr', 'acookmanr@163.com', 'Abigael Cookman', 'X9Dvrob8Uirq', 'imperdiet sapien urna pretium nisl ut volutpat sapien arcu sed', true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('aloebers', 'aloebers@sogou.com', 'Angil Loeber', 'IkA2g67Gp3e', 'interdum in ante vestibulum ante ipsum primis in faucibus orci luctus et', true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('vcreaseyt', 'vcreaseyt@nyu.edu', 'Vern Creasey', 'vUelwm', 'sit amet consectetuer adipiscing elit proin risus praesent lectus vestibulum quam sapien', true, 'Personal');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('admin1', 'admin1@gmail.com', 'admin1', 'admin1lalalalala', '', true, 'Admin');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('admin2', 'admin2@gmail.com', 'admin1', 'admin2lalalalala', '', true, 'Admin');
INSERT INTO users (username, email, name, password, description, active, user_type) VALUES ('admin3', 'admin3@gmail.com', 'admin1', 'admin3lalalalala', '', true, 'Admin');


--category
INSERT INTO category (name) VALUES ('Food');
INSERT INTO category (name) VALUES ('Film');
INSERT INTO category (name) VALUES ('Fitness');
INSERT INTO category (name) VALUES ('Music');
INSERT INTO category (name) VALUES ('Sports');
INSERT INTO category (name) VALUES ('Party');
INSERT INTO category (name) VALUES ('Tech');
INSERT INTO category (name) VALUES ('Workshop');
INSERT INTO category (name) VALUES ('Other');


--event
INSERT INTO event (title, date_created, date, location, description, price, capacity, is_private, id_owner, id_category, city,search_tokens) VALUES ('My 21st BDAY', '1/11/2018', '12/1/2020 02:11:00', '8446 Rockefeller Parkway', 'ut at dolor queima odio consequat varius', 127, 20, false, 12, 6, 'Vukatanë',null);

INSERT INTO event (title, date_created, date, location, description, price, capacity, is_private, id_owner, id_category, city,search_tokens) VALUES ('Tea Party', '11/30/2017', '6/8/2020 02:11:00', '95 Golf Center', 'lobortis est phasellus sit amet', 149, 483, false, 18, 8, 'Ajman',null);

INSERT INTO event (title, date_created, date, location, description, price, capacity, is_private, id_owner, id_category, city,search_tokens) VALUES ('Semana de Informatica', '11/3/2019 02:11:00', '10/5/2020', '877 Dayton Junction', 'libero nam dui proin leo odio porttitor id consequat in consequat ut', 126, 208, true, 3, 5, 'Xishan',null);

INSERT INTO event (title, date_created, date, location, description, price, capacity, is_private, id_owner, id_category, city,search_tokens) VALUES ('Queima 2019', '2/1/2018', '12/3/2020 02:11:00', '4 Bowman Park', 'sapien iaculis congue vivamus metus arcu adipiscing', 176, 451, false, 25, 2, 'Palaran',null);

INSERT INTO event (title, date_created, date, location, description, price, capacity, is_private, id_owner, id_category, city,search_tokens) VALUES ('Rock in Rio 2019', '10/29/2018', '7/25/2020 02:11:00', '81249 Summit Terrace', 'accumsan felis ut', 74, 399, true, 13, 9, 'Banjar Pekandelan',null);

INSERT INTO event (title, date_created, date, location, description, price, capacity, is_private, id_owner, id_category, city,search_tokens) VALUES ('Sleepover at Ritas', '11/21/2018', '7/30/2020 02:11:00', '71785 Mayer Court', 'morbi quis tortor', 81, 467, false, 17, 8, 'Rungis',null);

INSERT INTO event (title, date_created, date, location, description, price, capacity, is_private, id_owner, id_category, city,search_tokens) VALUES ('Feup Caffé', '10/13/2017', '9/7/2020 02:11:00', '264 Texas Plaza', 'luctus sleepover', 110, 376, false, 4, 5, 'Buga',null);

INSERT INTO event (title, date_created, date, location, description, price, capacity, is_private, id_owner, id_category, city,search_tokens) VALUES ('White Party', '3/5/2018', '9/17/2020 02:11:00', '588 Dayton Circle', 'nascetur ridiculus mus vivamus vestibulum sagittis sapien cum', 28, 96, false, 23, 5, 'Vinež',null);

INSERT INTO event (title, date_created, date, location, description, price, capacity, is_private, id_owner, id_category, city,search_tokens) VALUES ('Halloween Party', '9/8/2017', '10/27/2020 02:11:00', '621 Maple Road', 'at nunc commodo placerat praesent blandit nam', 21, 191, false, 5, 9, 'Martapura',null);

INSERT INTO event (title, date_created, date, location, description, price, capacity, is_private, id_owner, id_category, city,search_tokens) VALUES ( 'ENEI 2019', '1/21/2018', '7/30/2020 02:11:00', '3261 Pond Drive', 'nulla', 49, 136, false, 3, 9, 'Gaojingzhuang',null);

INSERT INTO event (title, date_created, date, location, description, price, capacity, is_private, id_owner, id_category, city,search_tokens) VALUES ( 'Talk a Bit', '2/9/2018', '10/6/2020 02:11:00', '012 Forest Pass', 'non velit nec nisi vulputate nonummy maecenas tincidunt lacus at velit', 21, 230, false, 16, 8, 'Sarimukti Kaler',null);

INSERT INTO event (title, date_created, date, location, description, price, capacity, is_private, id_owner, id_category, city,search_tokens) VALUES (  'Ted Talk Porto', '1/30/2018', '12/23/2020 02:11:00', '39189 Morningstar Road', 'justo lacinia eget tincidunt eget tempus vel pede morbi porttitor lorem', 122, 51, true, 2, 4, 'Shanhe',null);

INSERT INTO event (title, date_created, date, location, description, price, capacity, is_private, id_owner, id_category, city,search_tokens) VALUES (  '"Persistent leading edge application"', '10/21/2018', '12/21/2020 02:11:00', '365 Trailsway Junction', 'convallis morbi odio odio elementum eu interdum eu tincidunt in', 169, 481, true, 4, 8, 'Vistino',null);

INSERT INTO event (title, date_created, date, location, description, price, capacity, is_private, id_owner, id_category, city,search_tokens) VALUES ( 'Workshop React Pt1', '9/26/2017', '5/24/2020 02:11:00', '0167 Sloan Street', 'non velit nec nisi', 112, 57, true, 1, 1, '‘Amrān',null);

INSERT INTO event (title, date_created, date, location, description, price, capacity, is_private, id_owner, id_category, city,search_tokens) VALUES ( 'Workshop React Pt2', '9/15/2017', '5/15/2020 02:11:00', '2583 Monument Hill', 'ipsum primis in faucibus orci luctus et', 98, 287, false, 6, 4, 'Lincoln',null);

INSERT INTO event (title, date_created, date, location, description, price, capacity, is_private, id_owner, id_category, city,search_tokens) VALUES ( 'Baby shower', '3/25/2018', '8/3/2020 02:11:00', '675 Morningstar Plaza', 'vestibulum ante ipsum', 124, 379, true, 20, 8, 'Saint-Gaudens',null);

INSERT INTO event (title, date_created, date, location, description, price, capacity, is_private, id_owner, id_category, city,search_tokens) VALUES ( 'Billie Eilish Concert', '11/1/2017', '11/22/2020 02:11:00', '5807 Bartelt Street', 'in felis eu sapien cursus vestibulum proin eu', 88, 215, false, 30, 2, 'Krasnokamensk',null);

INSERT INTO event (title, date_created, date, location, description, price, capacity, is_private, id_owner, id_category, city,search_tokens) VALUES ( 'Billie Eilish meet & greet', '9/8/2017', '8/7/2020 02:11:00', '42474 Ohio Trail', 'queima non mi integer ac neque duis', 68, 78, false, 21, 4, 'Nicolas Bravo',null);

INSERT INTO event (title, date_created, date, location, description, price, capacity, is_private, id_owner, id_category, city,search_tokens) VALUES ( 'Billie Eilish fan queima convention', '12/10/2018', '8/21/2020 02:11:00', '980 Anderson Plaza', 'at turpis a pede', 125, 205, true, 20, 7, 'Firminópolis',null);

INSERT INTO event (title, date_created, date, location, description, price, capacity, is_private, id_owner, id_category, city,search_tokens) VALUES ( 'Time management talk', '11/16/2017', '7/5/2020 02:11:00', '36141 Westerfield Avenue', 'placerat praesent blandit nam nulla integer pede justo lacinia eget', 107, 183, false, 30, 7, 'Gonghe',null);


--personal
INSERT INTO personal (id_user) VALUES (1);
INSERT INTO personal (id_user) VALUES (2);
INSERT INTO personal (id_user) VALUES (3);
INSERT INTO personal (id_user) VALUES (4);
INSERT INTO personal (id_user) VALUES (5);
INSERT INTO personal (id_user) VALUES (6);
INSERT INTO personal (id_user) VALUES (7);
INSERT INTO personal (id_user) VALUES (8);
INSERT INTO personal (id_user) VALUES (9);
INSERT INTO personal (id_user) VALUES (10);
INSERT INTO personal (id_user) VALUES (11);
INSERT INTO personal (id_user) VALUES (12);
INSERT INTO personal (id_user) VALUES (13);
INSERT INTO personal (id_user) VALUES (14);
INSERT INTO personal (id_user) VALUES (15);
INSERT INTO personal (id_user) VALUES (16);
INSERT INTO personal (id_user) VALUES (17);
INSERT INTO personal (id_user) VALUES (18);
INSERT INTO personal (id_user) VALUES (19);
INSERT INTO personal (id_user) VALUES (20);


--business
INSERT INTO business (id_user, verification, website) VALUES (21, 'Approved', 'https://businessinsider.com');
INSERT INTO business (id_user, verification, website) VALUES (22, 'Approved', 'https://europa.eu');
INSERT INTO business (id_user, verification, website) VALUES (23, 'Pending', 'https://studiopress.com');
INSERT INTO business (id_user, verification, website) VALUES (24, 'Approved', 'https://creativecommons.org');
INSERT INTO business (id_user, verification, website) VALUES (25, 'Pending', 'http://bbc.co.uk');
INSERT INTO business (id_user, verification, website) VALUES (26, 'Pending', 'https://harvard.edu');
INSERT INTO business (id_user, verification, website) VALUES (27, 'Approved', 'http://cnn.com');
INSERT INTO business (id_user, verification, website) VALUES (28, 'Approved', 'https://webs.com');
INSERT INTO business (id_user, verification, website) VALUES (29, 'Pending', 'http://chronoengine.com');
INSERT INTO business (id_user, verification, website) VALUES (30, 'Approved', 'http://yahoo.com');


--post
INSERT INTO post (date, text, id_event, id_author, post_type) VALUES ('5/16/2018', 'pede lobortis ligula sit amet eleifend pede libero quis orci nullam molestie nibh in lectus pellentesque at nulla suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus etiam vel augue vestibulum rutrum rutrum neque aenean auctor gravida sem praesent id massa id nisl venenatis lacinia aenean sit amet justo morbi ut odio cras mi pede malesuada', 9, 23,'Poll');
INSERT INTO post (date, text, id_event, id_author, post_type) VALUES ('11/7/2018', 'integer non velit donec diam neque vestibulum eget vulputate ut ultrices vel augue vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae donec pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin mi sit amet lobortis sapien sapien non mi integer ac neque duis bibendum morbi non quam nec dui luctus rutrum nulla tellus in sagittis dui vel nisl duis ac nibh fusce lacus purus aliquet at feugiat non pretium quis lectus suspendisse potenti in eleifend quam a odio in hac habitasse platea dictumst maecenas ut massa quis', 10, 9,'File');
INSERT INTO post (date, text, id_event, id_author, post_type) VALUES ('5/3/2018', 'luctus cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus vivamus', 7, 9,'Poll');
INSERT INTO post (date, text, id_event, id_author, post_type) VALUES ('9/10/2018', 'aliquet pulvinar sed nisl nunc rhoncus dui vel sem sed sagittis nam congue risus semper porta volutpat quam pede lobortis ligula sit amet eleifend pede libero quis orci nullam molestie nibh in lectus pellentesque at nulla suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus', 19, 22,'Poll');
INSERT INTO post (date, text, id_event, id_author, post_type) VALUES ('12/14/2018', 'porttitor lacus at turpis donec posuere metus vitae ipsum aliquam non mauris morbi non lectus aliquam sit amet diam in magna bibendum imperdiet nullam orci pede venenatis non sodales sed tincidunt eu felis fusce', 10, 25,'File');
INSERT INTO post (date, text, id_event, id_author, post_type) VALUES ('3/12/2019', 'volutpat sapien arcu sed augue aliquam erat volutpat in congue etiam justo etiam pretium iaculis justo in hac habitasse platea dictumst etiam faucibus cursus urna ut tellus nulla ut erat id mauris vulputate elementum nullam varius nulla facilisi cras non velit nec nisi vulputate nonummy maecenas tincidunt lacus at velit vivamus vel nulla eget eros elementum pellentesque quisque porta volutpat erat quisque erat eros viverra eget congue eget semper rutrum nulla nunc purus phasellus in felis donec semper sapien a libero nam dui proin leo odio porttitor id', 17, 26,'File');
INSERT INTO post (date, text, id_event, id_author, post_type) VALUES ('11/5/2018', 'non ligula pellentesque ultrices phasellus id sapien in sapien iaculis congue vivamus metus arcu adipiscing molestie hendrerit at vulputate vitae nisl aenean lectus pellentesque eget nunc donec quis orci eget orci vehicula condimentum curabitur in libero ut massa volutpat convallis morbi odio odio elementum eu interdum eu tincidunt in leo maecenas pulvinar lobortis est phasellus sit amet erat nulla tempus vivamus in felis eu sapien cursus vestibulum proin eu mi nulla ac enim in tempor turpis nec euismod scelerisque quam turpis adipiscing lorem vitae mattis nibh ligula nec sem duis aliquam convallis nunc proin', 17, 11,'File');
INSERT INTO post (date, text, id_event, id_author, post_type) VALUES ('1/5/2019', 'velit id pretium iaculis diam erat fermentum justo nec condimentum neque sapien placerat ante nulla justo aliquam quis turpis eget elit sodales scelerisque mauris sit amet eros suspendisse accumsan tortor quis turpis sed ante vivamus tortor duis mattis egestas metus aenean fermentum donec ut mauris eget massa tempor convallis nulla neque libero convallis eget eleifend luctus ultricies', 4, 11,'File');
INSERT INTO post (date, text, id_event, id_author, post_type) VALUES ('9/17/2018', 'ultrices enim lorem ipsum dolor sit amet consectetuer adipiscing elit proin interdum mauris non ligula pellentesque ultrices phasellus id sapien in sapien iaculis congue vivamus metus arcu adipiscing molestie hendrerit at vulputate vitae nisl aenean lectus pellentesque eget nunc donec quis orci eget orci vehicula condimentum curabitur in libero ut massa volutpat convallis morbi odio odio elementum eu interdum eu', 9, 2,'File');
INSERT INTO post (date, text, id_event, id_author, post_type) VALUES ('5/20/2018', 'ligula nec sem duis aliquam convallis nunc proin at turpis a pede posuere nonummy integer non velit donec diam neque vestibulum eget vulputate ut ultrices vel augue vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae donec pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin mi sit amet lobortis sapien sapien non mi integer ac neque duis bibendum morbi non quam nec dui luctus rutrum nulla tellus', 14, 24,'File');
INSERT INTO post (date, text, id_event, id_author, post_type) VALUES ('9/10/2018', 'ut odio', 9, 27,'Poll');
INSERT INTO post (date, text, id_event, id_author, post_type) VALUES ('2/21/2019', 'erat eros viverra eget congue eget semper rutrum nulla nunc purus phasellus in felis donec semper sapien a libero nam dui proin leo odio porttitor id consequat in consequat ut nulla sed accumsan felis ut', 4, 2,'Poll');
INSERT INTO post (date, text, id_event, id_author, post_type) VALUES ('4/19/2018', 'nunc purus', 12, 10,'File');
INSERT INTO post (date, text, id_event, id_author, post_type) VALUES ('9/13/2018', 'platea dictumst maecenas ut massa quis augue luctus tincidunt nulla mollis molestie lorem quisque ut erat curabitur gravida nisi at nibh in hac habitasse platea dictumst aliquam augue quam sollicitudin vitae consectetuer eget rutrum at lorem integer tincidunt ante vel ipsum praesent blandit lacinia erat vestibulum sed magna at nunc commodo placerat praesent blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat lectus in est risus auctor sed tristique in tempus sit amet', 8, 1,'File');
INSERT INTO post (date, text, id_event, id_author, post_type) VALUES ('7/11/2018', 'parturient montes nascetur ridiculus mus etiam vel augue vestibulum rutrum rutrum', 10, 2,'File');


--file
INSERT INTO file (name, id_post) VALUES ('hac_habitasse.tcsh', 15);
INSERT INTO file (name, id_post) VALUES ('pulvinar_lobortis.def', 10);
INSERT INTO file (name, id_post) VALUES ('convallis_eget_eleifend.wbmp', 8);
INSERT INTO file (name, id_post) VALUES ('id_justo_sit.wrl', 14);
INSERT INTO file (name, id_post) VALUES ('nulla_facilisi.m', 13);
INSERT INTO file (name, id_post) VALUES ('sed_interdum_venenatis.jam', 2);
INSERT INTO file (name, id_post) VALUES ('ut_nulla_sed.nsc', 9);
INSERT INTO file (name, id_post) VALUES ('congue.part', 6);
INSERT INTO file (name, id_post) VALUES ('non_velit.z', 7);
INSERT INTO file (name, id_post) VALUES ('vulputate_nonummy.sst', 5);


--poll
INSERT INTO poll (id_post) VALUES (1);
INSERT INTO poll (id_post) VALUES (3);
INSERT INTO poll (id_post) VALUES (4);
INSERT INTO poll (id_post) VALUES (11);
INSERT INTO poll (id_post) VALUES (12);


--poll_option
INSERT INTO poll_option (name, id_poll) VALUES ('bus', 1);
INSERT INTO poll_option (name, id_poll) VALUES ('train', 1);
INSERT INTO poll_option (name, id_poll) VALUES ('car', 1);
INSERT INTO poll_option (name, id_poll) VALUES ('blue', 2);
INSERT INTO poll_option (name, id_poll) VALUES ('red', 2);
INSERT INTO poll_option (name, id_poll) VALUES ('30', 3);
INSERT INTO poll_option (name, id_poll) VALUES ('20', 3);
INSERT INTO poll_option (name, id_poll) VALUES ('thursday', 4);
INSERT INTO poll_option (name, id_poll) VALUES ('friday', 4);
INSERT INTO poll_option (name, id_poll) VALUES ('lisbon', 5);
INSERT INTO poll_option (name, id_poll) VALUES ('porto', 5);


--voteOnOption
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (1, 1, 1);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (1, 2, 4);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (1, 3, 6);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (2, 1, 1);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (2, 3, 6);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (2, 2, 5);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (3, 1, 1);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (4, 1, 2);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (5, 1, 3);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (6, 2, 4);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (7, 2, 5);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (8, 1, 1);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (9, 1, 2);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (10, 1, 3);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (10, 2, 4);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (11, 1, 1);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (11, 2, 4);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (11, 3, 6);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (11, 4, 8);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (12, 1, 1);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (13, 1, 2);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (14, 1, 3);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (20, 2, 4);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (22, 5, 10);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (21, 4, 8);
INSERT INTO vote_on_poll (id_user, id_poll, id_poll_option) VALUES (21, 3, 6);


--invite
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (12, 1, 1);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (12, 18, 1);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (3, 1, 3);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (3, 2, 3);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (3, 3, 3);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (13, 2, 5);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (13, 4, 5);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (13, 5, 5);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (13, 15, 5);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (3, 19, 10);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (2, 11, 12);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (2, 11, 11);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (2, 13, 12);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (2, 15, 12);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (2, 19, 12);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (20, 15, 16);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (2, 20, 4);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (2, 1, 6);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (2, 10, 6);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (20, 18, 20);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (12, 3, 1);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (12, 5, 1);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (3, 13, 3);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (3, 20, 3);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (3, 15, 3);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (13, 20, 5);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (13, 14, 5);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (13, 6, 5);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (13, 1, 5);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (3, 9, 10);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (2, 1, 12);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (2, 3, 12);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (2, 5, 12);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (2, 9, 12);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (20, 2, 16);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (2, 10, 4);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (2, 9, 6);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (2, 19, 6);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (20, 8, 20);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (2, 3, 2);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (2, 1, 2);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (2, 4, 2);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (20, 5, 2);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (20, 2, 2);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (2, 4, 4);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (20, 5, 4);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (20, 3, 4);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (3, 7, 6);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (3, 8, 7);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (3, 9, 8);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (13, 8, 5);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (13, 7, 5);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (2, 14, 12);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (1, 18, 14);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (1, 20, 14);
INSERT INTO invite (id_inviter, id_invitee, id_event) VALUES (4, 12, 13);



--ticket
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (1, 1,'5/16/2018',false);
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (2, 1,'5/10/2018',false);
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (1, 3,'12/13/2018',false);
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (1, 4,'5/16/2018',false);
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (2, 2,'2/12/2018',false);
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (2, 3,'6/23/2018',false);
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (2, 4,'10/2/2018',false);
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (2, 5,'9/21/2018',false);
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (4, 3,'8/7/2018',false);
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (4, 18,'8/7/2018',false);
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (4, 12,'8/7/2018',false);
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (4, 4,'11/11/2018',false);
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (4, 5,'5/16/2018',false);
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (5, 8,'10/7/2018',false);
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (5, 7,'9/13/2018',false);
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (5, 5,'3/3/2018',false);
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (6, 7,'6/6/2018',false);
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (7, 8,'5/16/2018',false);
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (8, 9,'11/11/2018',false);
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (9, 10,'9/28/2018',false);
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (12, 14,'2/4/2018',false);
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (12, 11,'2/6/2018',false);
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (13, 12,'10/4/2018',false);
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (14, 20,'7/17/2018',false);
INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (14, 18,'12/12/2018',false);

--follow
INSERT INTO follow (id_user1, id_user2) VALUES (15, 6);
INSERT INTO follow (id_user1, id_user2) VALUES (10, 1);
INSERT INTO follow (id_user1, id_user2) VALUES (5, 1);
INSERT INTO follow (id_user1, id_user2) VALUES (12, 15);
INSERT INTO follow (id_user1, id_user2) VALUES (19, 10);
INSERT INTO follow (id_user1, id_user2) VALUES (6, 6);
INSERT INTO follow (id_user1, id_user2) VALUES (16, 3);
INSERT INTO follow (id_user1, id_user2) VALUES (12, 12);
INSERT INTO follow (id_user1, id_user2) VALUES (8, 14);
INSERT INTO follow (id_user1, id_user2) VALUES (13, 10);
INSERT INTO follow (id_user1, id_user2) VALUES (18, 18);
INSERT INTO follow (id_user1, id_user2) VALUES (10, 21);
INSERT INTO follow (id_user1, id_user2) VALUES (14, 8);
INSERT INTO follow (id_user1, id_user2) VALUES (20, 5);
INSERT INTO follow (id_user1, id_user2) VALUES (8, 19);
INSERT INTO follow (id_user1, id_user2) VALUES (11, 19);
INSERT INTO follow (id_user1, id_user2) VALUES (18, 23);
INSERT INTO follow (id_user1, id_user2) VALUES (19, 12);
INSERT INTO follow (id_user1, id_user2) VALUES (1, 7);
INSERT INTO follow (id_user1, id_user2) VALUES (17, 14);
INSERT INTO follow (id_user1, id_user2) VALUES (1, 27);
INSERT INTO follow (id_user1, id_user2) VALUES (3, 12);
INSERT INTO follow (id_user1, id_user2) VALUES (1, 17);
INSERT INTO follow (id_user1, id_user2) VALUES (4, 23);
INSERT INTO follow (id_user1, id_user2) VALUES (12, 20);
INSERT INTO follow (id_user1, id_user2) VALUES (20, 30);
INSERT INTO follow (id_user1, id_user2) VALUES (1, 25);
INSERT INTO follow (id_user1, id_user2) VALUES (7, 14);
INSERT INTO follow (id_user1, id_user2) VALUES (14, 1);
INSERT INTO follow (id_user1, id_user2) VALUES (4, 8);
INSERT INTO follow (id_user1, id_user2) VALUES (5, 19);
INSERT INTO follow (id_user1, id_user2) VALUES (19, 11);
INSERT INTO follow (id_user1, id_user2) VALUES (1, 22);
INSERT INTO follow (id_user1, id_user2) VALUES (14, 2);
INSERT INTO follow (id_user1, id_user2) VALUES (7, 6);
INSERT INTO follow (id_user1, id_user2) VALUES (19, 2);
INSERT INTO follow (id_user1, id_user2) VALUES (1, 21);
INSERT INTO follow (id_user1, id_user2) VALUES (1, 30);
INSERT INTO follow (id_user1, id_user2) VALUES (8, 20);
INSERT INTO follow (id_user1, id_user2) VALUES (9, 6);
INSERT INTO follow (id_user1, id_user2) VALUES (7, 20);
INSERT INTO follow (id_user1, id_user2) VALUES (1, 15);
INSERT INTO follow (id_user1, id_user2) VALUES (4, 16);
INSERT INTO follow (id_user1, id_user2) VALUES (20, 10);
INSERT INTO follow (id_user1, id_user2) VALUES (6, 19);
INSERT INTO follow (id_user1, id_user2) VALUES (16, 5);
INSERT INTO follow (id_user1, id_user2) VALUES (20, 11);
INSERT INTO follow (id_user1, id_user2) VALUES (6, 7);
INSERT INTO follow (id_user1, id_user2) VALUES (13, 18);
INSERT INTO follow (id_user1, id_user2) VALUES (6, 25);
INSERT INTO follow (id_user1, id_user2) VALUES (18, 30);
INSERT INTO follow (id_user1, id_user2) VALUES (8, 22);
INSERT INTO follow (id_user1, id_user2) VALUES (18, 5);
INSERT INTO follow (id_user1, id_user2) VALUES (14, 14);
INSERT INTO follow (id_user1, id_user2) VALUES (11, 17);
INSERT INTO follow (id_user1, id_user2) VALUES (14, 3);
INSERT INTO follow (id_user1, id_user2) VALUES (5, 16);
INSERT INTO follow (id_user1, id_user2) VALUES (5, 24);
INSERT INTO follow (id_user1, id_user2) VALUES (14, 15);
INSERT INTO follow (id_user1, id_user2) VALUES (16, 23);
INSERT INTO follow (id_user1, id_user2) VALUES (10, 18);
INSERT INTO follow (id_user1, id_user2) VALUES (3, 18);
INSERT INTO follow (id_user1, id_user2) VALUES (18, 2);
INSERT INTO follow (id_user1, id_user2) VALUES (4, 18);
INSERT INTO follow (id_user1, id_user2) VALUES (8, 13);
INSERT INTO follow (id_user1, id_user2) VALUES (6, 11);
INSERT INTO follow (id_user1, id_user2) VALUES (1, 16);
INSERT INTO follow (id_user1, id_user2) VALUES (17, 8);
INSERT INTO follow (id_user1, id_user2) VALUES (6, 17);
INSERT INTO follow (id_user1, id_user2) VALUES (12, 26);
INSERT INTO follow (id_user1, id_user2) VALUES (2, 10);
INSERT INTO follow (id_user1, id_user2) VALUES (17, 12);
INSERT INTO follow (id_user1, id_user2) VALUES (14, 23);
INSERT INTO follow (id_user1, id_user2) VALUES (11, 3);
INSERT INTO follow (id_user1, id_user2) VALUES (8, 30);
INSERT INTO follow (id_user1, id_user2) VALUES (18, 27);
INSERT INTO follow (id_user1, id_user2) VALUES (6, 18);
INSERT INTO follow (id_user1, id_user2) VALUES (15, 1);
INSERT INTO follow (id_user1, id_user2) VALUES (4, 9);
INSERT INTO follow (id_user1, id_user2) VALUES (20, 4);
INSERT INTO follow (id_user1, id_user2) VALUES (7, 7);
INSERT INTO follow (id_user1, id_user2) VALUES (6, 15);
INSERT INTO follow (id_user1, id_user2) VALUES (14, 22);
INSERT INTO follow (id_user1, id_user2) VALUES (1, 23);
INSERT INTO follow (id_user1, id_user2) VALUES (7, 24);
INSERT INTO follow (id_user1, id_user2) VALUES (14, 7);
INSERT INTO follow (id_user1, id_user2) VALUES (12, 18);
INSERT INTO follow (id_user1, id_user2) VALUES (15, 16);
INSERT INTO follow (id_user1, id_user2) VALUES (1, 14);
INSERT INTO follow (id_user1, id_user2) VALUES (14, 30);
INSERT INTO follow (id_user1, id_user2) VALUES (20, 20);
INSERT INTO follow (id_user1, id_user2) VALUES (11, 4);
INSERT INTO follow (id_user1, id_user2) VALUES (4, 25);
INSERT INTO follow (id_user1, id_user2) VALUES (11, 2);
INSERT INTO follow (id_user1, id_user2) VALUES (15, 18);
INSERT INTO follow (id_user1, id_user2) VALUES (14, 20);
INSERT INTO follow (id_user1, id_user2) VALUES (17, 30);
INSERT INTO follow (id_user1, id_user2) VALUES (15, 11);
INSERT INTO follow (id_user1, id_user2) VALUES (14, 19);
INSERT INTO follow (id_user1, id_user2) VALUES (6, 1);


--comment
INSERT INTO comment (text, id_post, id_parent_comment, id_author, date) VALUES ('vehicula condimentum curabitur in libero ut massa volutpat convallis morbi odio odio elementum eu interdum eu tincidunt in leo maecenas pulvinar lobortis est phasellus sit amet erat nulla tempus vivamus in felis eu sapien cursus vestibulum proin eu mi nulla', 13, null, 1, '5/16/2018');
INSERT INTO comment (text, id_post, id_parent_comment, id_author, date) VALUES ('augue aliquam erat volutpat in congue etiam justo etiam pretium iaculis justo in hac habitasse platea dictumst etiam faucibus cursus urna ut tellus nulla ut erat id mauris vulputate elementum nullam varius nulla facilisi cras non velit nec nisi vulputate nonummy maecenas tincidunt lacus at velit vivamus vel nulla eget eros elementum pellentesque quisque porta volutpat erat quisque erat eros viverra eget congue eget semper rutrum nulla nunc purus', 15, null, 2, '5/16/2018');
INSERT INTO comment (text, id_post, id_parent_comment, id_author, date) VALUES ('ut dolor morbi vel lectus in quam fringilla rhoncus mauris enim leo rhoncus sed vestibulum sit amet cursus id turpis integer aliquet massa id lobortis convallis tortor risus dapibus augue vel accumsan tellus nisi eu orci mauris lacinia sapien quis libero nullam sit amet turpis elementum ligula vehicula consequat morbi', 2, null, 3, '5/16/2018');
INSERT INTO comment (text, id_post, id_parent_comment, id_author, date) VALUES ('sapien in sapien', 1, null, 4, '5/16/2018');
INSERT INTO comment (text, id_post, id_parent_comment, id_author, date) VALUES ('dictumst aliquam augue quam sollicitudin vitae consectetuer eget rutrum at lorem ', 3, null, 5, '5/16/2018');
INSERT INTO comment (text, id_post, id_parent_comment, id_author, date) VALUES ('augue vel accumsan tellus nisi eu orci mauris lacinia sapien quis libero nullam sit amet turpis elementum ligula vehicula consequat morbi a ipsum integer a nibh', 2, null, 15, '5/16/2018');
INSERT INTO comment (text, id_post, id_parent_comment, id_author, date) VALUES ('pede posuere nonummy integer non velit donec diam neque vestibulum eget vulputate ut ultrices vel augue', 10, null, 16, '5/16/2018');
INSERT INTO comment (text, id_post, id_parent_comment, id_author, date) VALUES ('velit nec', 7, null, 17, '5/16/2018');
INSERT INTO comment (text, id_post, id_parent_comment, id_author, date) VALUES ('ut volutpat sapien arcu sed augue aliquam erat volutpat in congue etiam justo etiam pretium iaculis justo in hac habitasse platea dictumst etiam faucibus cursus urna ut tellus nulla ut erat id mauris vulputate elementum nullam varius nulla facilisi cras non velit nec nisi vulputate nonummy maecenas tincidunt lacus at velit vivamus vel nulla eget eros elementum pellentesque quisque porta volutpat erat quisque erat eros viverra eget congue eget semper rutrum nulla nunc purus', 3, null, 18, '5/16/2018');
INSERT INTO comment (text, id_post, id_parent_comment, id_author, date) VALUES ('gravida nisi at nibh in hac habitasse platea dictumst aliquam augue quam sollicitudin vitae consectetuer eget rutrum at lorem integer tincidunt ante vel ipsum praesent blandit lacinia erat vestibulum sed magna at nunc commodo placerat praesent blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus vel pede morbi', 14, null, 19, '5/16/2018');
INSERT INTO comment (text, id_post, id_parent_comment, id_author, date) VALUES ('amet sem fusce consequat nulla nisl nunc nisl duis bibendum felis sed interdum venenatis turpis enim blandit mi in porttitor pede justo eu massa donec dapibus duis at velit eu est congue elementum in hac habitasse platea dictumst morbi vestibulum velit id pretium iaculis diam erat fermentum justo nec', null, 1, 20, '5/16/2018');
INSERT INTO comment (text, id_post, id_parent_comment, id_author, date) VALUES ('auctor sed tristique in tempus sit amet sem fusce consequat nulla nisl nunc nisl duis bibendum felis sed interdum venenatis turpis enim blandit mi in porttitor pede justo eu massa donec dapibus duis at velit eu est congue elementum in hac habitasse platea dictumst morbi vestibulum velit id pretium iaculis diam erat fermentum justo nec condimentum neque sapien placerat', null, 2, 21, '5/16/2018');
INSERT INTO comment (text, id_post, id_parent_comment, id_author, date) VALUES ('vulputate vitae nisl aenean lectus pellentesque eget nunc', 5, null, 22, '5/16/2018');
INSERT INTO comment (text, id_post, id_parent_comment, id_author, date) VALUES ('a nibh in quis justo maecenas rhoncus aliquam lacus morbi quis tortor id nulla ultrices aliquet maecenas leo odio condimentum id luctus nec molestie sed justo pellentesque viverra pede ac diam cras pellentesque', null, 2, 23, '5/16/2018');
INSERT INTO comment (text, id_post, id_parent_comment, id_author, date) VALUES ('sit amet sapien dignissim vestibulum vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae nulla dapibus dolor vel est donec odio justo sollicitudin ut suscipit', null, 3, 24, '5/16/2018');
INSERT INTO comment (text, id_post, id_parent_comment, id_author, date) VALUES ('in est risus auctor sed tristique in tempus sit amet sem fusce consequat nulla nisl', 8, null, 25, '5/16/2018');
INSERT INTO comment (text, id_post, id_parent_comment, id_author, date) VALUES ('ligula sit amet eleifend pede libero quis orci nullam molestie nibh in lectus pellentesque at nulla suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus etiam vel augue vestibulum rutrum rutrum neque aenean auctor gravida sem praesent id massa id nisl venenatis ', null, 4, 26, '5/16/2018');
INSERT INTO comment (text, id_post, id_parent_comment, id_author, date) VALUES ('ultrices posuere cubilia curae duis faucibus accumsan odio curabitur convallis duis consequat dui nec nisi volutpat eleifend donec ut dolor morbi vel lectus in quam fringilla rhoncus mauris enim leo rhoncus sed vestibulum sit amet cursus id turpis integer aliquet massa id lobortis convallis tortor', null, 5, 27, '5/16/2018');
INSERT INTO comment (text, id_post, id_parent_comment, id_author, date) VALUES ('nulla suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus etiam vel augue vestibulum rutrum rutrum neque aenean', null, 5, 28, '5/16/2018');
INSERT INTO comment (text, id_post, id_parent_comment, id_author, date) VALUES ('tellus nisi eu orci ', null, 6, 29, '5/16/2018');


--report
INSERT INTO report (reason, veridict, report_type, id_admin) VALUES ('Innapropriate', 'Approved', 'Post', 31);
INSERT INTO report (reason, veridict, report_type, id_admin) VALUES ('Innapropriate', 'Pending', 'Event', null);
INSERT INTO report (reason, veridict, report_type, id_admin) VALUES ('Invasion Of Privacy', 'Pending', 'User', null);
INSERT INTO report (reason, veridict, report_type, id_admin) VALUES ('Offensive', 'Approved', 'Post', 32);
INSERT INTO report (reason, veridict, report_type, id_admin) VALUES ('Offensive', 'Ignored', 'Event', 32);
INSERT INTO report (reason, veridict, report_type, id_admin) VALUES ('Invasion Of Privacy', 'Pending', 'User', null);
INSERT INTO report (reason, veridict, report_type, id_admin) VALUES ('Contains Explicit Content', 'Pending', 'Post', null);
INSERT INTO report (reason, veridict, report_type, id_admin) VALUES ('Offensive', 'Ignored', 'Event', 33);


--report_event
INSERT INTO report_event (id_report, id_reporter, id_event) VALUES (2, 1, 1);
INSERT INTO report_event (id_report, id_reporter, id_event) VALUES (5, 2, 2);
INSERT INTO report_event (id_report, id_reporter, id_event) VALUES (8, 2, 1);

--report_post
INSERT INTO report_post (id_report, id_reporter, id_post) VALUES (1, 10, 1);
INSERT INTO report_post (id_report, id_reporter, id_post) VALUES (4, 11, 2);
INSERT INTO report_post (id_report, id_reporter, id_post) VALUES (7, 12, 3);

--report_user
INSERT INTO report_user (id_report, id_reporter, id_reported_user) VALUES (3, 6, 2);
INSERT INTO report_user (id_report, id_reporter, id_reported_user) VALUES (6, 3, 5);
