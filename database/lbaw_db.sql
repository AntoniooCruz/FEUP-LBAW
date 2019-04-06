-- Types
DROP TYPE IF EXISTS verification_state CASCADE;
CREATE TYPE verification_state AS ENUM ('Pending', 'Approved');

DROP TYPE IF EXISTS report_state CASCADE;
CREATE TYPE report_state AS ENUM ('Pending', 'Approved', 'Ignored');

DROP TYPE IF EXISTS report_types CASCADE;
CREATE TYPE report_types AS ENUM ('Post', 'Event', 'User') ;


-- Table: users
DROP TABLE IF EXISTS users CASCADE;

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
    is_admin BOOLEAN NOT NULL DEFAULT FALSE
);

-- Table: category
DROP TABLE IF EXISTS category CASCADE;

CREATE TABLE category (
    id_category SERIAL      PRIMARY KEY,
    name        VARCHAR (20) UNIQUE
                             NOT NULL
);


-- Table: event
DROP TABLE IF EXISTS event CASCADE;

CREATE TABLE event (
    id_event     SERIAL       PRIMARY KEY,
    title        VARCHAR (50)  NOT NULL,
    date_created DATE          NOT NULL
                               DEFAULT (now() ),
    date         DATE          NOT NULL,
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
DROP TABLE IF EXISTS post CASCADE;

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
DROP TABLE IF EXISTS attend_event CASCADE;

CREATE TABLE attend_event (
    id_user INTEGER REFERENCES users (id_user) ON DELETE CASCADE,
    id_event  INTEGER REFERENCES event (id_event) ON DELETE CASCADE,
    PRIMARY KEY (
        id_user,
        id_event
    )
);


-- Table: business
DROP TABLE IF EXISTS business CASCADE;

CREATE TABLE business (
    id_user    INTEGER PRIMARY KEY
                         REFERENCES users (id_user) ON DELETE CASCADE,
    verification verification_state    DEFAULT ('Pending') 
                         NOT NULL,
    website      TEXT
);

-- Table: personal
DROP TABLE IF EXISTS personal CASCADE;

CREATE TABLE personal (
    id_user INTEGER PRIMARY KEY
                    REFERENCES users (id_user) ON DELETE CASCADE
);


-- Table: comment
DROP TABLE IF EXISTS comment CASCADE;

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
DROP TABLE IF EXISTS file CASCADE;

CREATE TABLE file (
    id_file SERIAL PRIMARY KEY,
    name    VARCHAR NOT NULL,
    id_post INTEGER NOT NULL
                    REFERENCES post (id_post) ON DELETE CASCADE
);


-- Table: follow
DROP TABLE IF EXISTS follow CASCADE;

CREATE TABLE follow (
    id_user1 INTEGER REFERENCES personal (id_user) ON DELETE CASCADE,
    id_user2 INTEGER REFERENCES users (id_user) ON DELETE CASCADE,
    PRIMARY KEY (
        id_user1,
        id_user2
    )
);


-- Table: invite
DROP TABLE IF EXISTS invite CASCADE;

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
DROP TABLE IF EXISTS report CASCADE;

CREATE TABLE report (
    id_report SERIAL      PRIMARY KEY,
    reason    VARCHAR (300) NOT NULL,
    veridict  report_state DEFAULT ('Pending') 
                           NOT NULL,
    report_type report_types,
    id_admin INTEGER REFERENCES users (id_user) ON DELETE CASCADE
);


-- Table: poll
DROP TABLE IF EXISTS poll CASCADE;

CREATE TABLE poll (
    id_poll SERIAL PRIMARY KEY,
    id_post INTEGER REFERENCES post (id_post) ON DELETE CASCADE
                    NOT NULL
);


-- Table: poll_option
DROP TABLE IF EXISTS poll_option CASCADE;

CREATE TABLE poll_option (
    id_poll_option SERIAL      PRIMARY KEY,
    name           VARCHAR (20) NOT NULL,
    id_poll        INTEGER      REFERENCES poll (id_poll) ON DELETE CASCADE
                                NOT NULL
);


-- Table: report_event
DROP TABLE IF EXISTS report_event CASCADE;

CREATE TABLE report_event (
    id_report   INTEGER PRIMARY KEY
                        REFERENCES report (id_report) ON DELETE CASCADE,
    id_reporter INTEGER NOT NULL
                        REFERENCES users (id_user) ON DELETE CASCADE,
    id_event    INTEGER NOT NULL
                        REFERENCES event (id_event) ON DELETE CASCADE
);


-- Table: report_post
DROP TABLE IF EXISTS report_post CASCADE;

CREATE TABLE report_post (
    id_report   INTEGER PRIMARY KEY
                        REFERENCES report (id_report) ON DELETE CASCADE,
    id_reporter INTEGER NOT NULL
                        REFERENCES users (id_user) ON DELETE CASCADE,
    id_post     INTEGER REFERENCES post (id_post) ON DELETE CASCADE
                        NOT NULL
);


-- Table: report_user
DROP TABLE IF EXISTS report_user CASCADE;

CREATE TABLE report_user (
    id_report          INTEGER REFERENCES report (id_report) ON DELETE CASCADE
                               PRIMARY KEY,
    id_reporter        INTEGER REFERENCES users (id_user) ON DELETE CASCADE
                               NOT NULL,
    id_reported_user INTEGER REFERENCES users (id_user) ON DELETE CASCADE
                               NOT NULL
);


-- Table: ticket
DROP TABLE IF EXISTS ticket CASCADE;

CREATE TABLE ticket (
    token           SERIAL PRIMARY KEY,
    id_event        INTEGER REFERENCES event (id_event) ON DELETE CASCADE
                            NOT NULL,
    id_ticket_owner INTEGER REFERENCES personal (id_user) ON DELETE CASCADE
                            NOT NULL
);


-- Table: vote_on_poll
DROP TABLE IF EXISTS vote_on_poll CASCADE;

CREATE TABLE vote_on_poll (
    id_user        INTEGER REFERENCES users (id_user) ON DELETE CASCADE,
    id_poll_option INTEGER REFERENCES poll_option (id_poll_option) ON DELETE CASCADE,
    PRIMARY KEY (
        id_user,
        id_poll_option
    )
);

