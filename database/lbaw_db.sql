-- Types
DROP TYPE IF EXISTS verification_state;
CREATE TYPE verification_state AS ENUM ('Pending', 'Approved');

DROP TYPE IF EXISTS report_state;
CREATE TYPE report_state AS ENUM ('Pending', 'Approved', 'Ignored');


-- Table: users
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id_user  INTEGER      PRIMARY KEY,
    username VARCHAR (15) UNIQUE
                          NOT NULL,
    email    VARCHAR      UNIQUE
                          NOT NULL,
    name     VARCHAR (20) NOT NULL,
    password VARCHAR      NOT NULL
);


-- Table: member
DROP TABLE IF EXISTS member;

CREATE TABLE member (
    id_user     INTEGER       PRIMARY KEY
                              REFERENCES users (id_user) ON DELETE CASCADE,
    description VARCHAR (100) 
);

-- Table: admin
DROP TABLE IF EXISTS admin;

CREATE TABLE admin (
    id_user INTEGER PRIMARY KEY
                  REFERENCES users (id_user) ON DELETE CASCADE
);


-- Table: category
DROP TABLE IF EXISTS category;

CREATE TABLE category (
    id_category INTEGER      PRIMARY KEY,
    name        VARCHAR (20) UNIQUE
                             NOT NULL
);


-- Table: event
DROP TABLE IF EXISTS event;

CREATE TABLE event (
    id_event     INTEGER       PRIMARY KEY,
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
    id_owner     INTEGER       REFERENCES member (id_user) ON DELETE CASCADE,
    id_category  INTEGER       REFERENCES category (id_category) ON DELETE CASCADE,
    city         VARCHAR (30),

    CONSTRAINT event_dates CHECK ("date" > date_created)
);


-- Table: post
DROP TABLE IF EXISTS post;

CREATE TABLE post (
    id_post   INTEGER       PRIMARY KEY,
    date      DATE          NOT NULL
                            DEFAULT (now() ),
    text      VARCHAR (140),
    id_event  INTEGER       REFERENCES event (id_event) ON DELETE CASCADE
                            NOT NULL,
    id_author INTEGER       REFERENCES member (id_user) ON DELETE CASCADE
                            NOT NULL
);


-- Table: attend_event
DROP TABLE IF EXISTS attend_event;

CREATE TABLE attend_event (
    id_member INTEGER REFERENCES member (id_user) ON DELETE CASCADE,
    id_event  INTEGER REFERENCES event (id_event) ON DELETE CASCADE,
    PRIMARY KEY (
        id_member,
        id_event
    )
);


-- Table: business
DROP TABLE IF EXISTS business;

CREATE TABLE business (
    id_member    INTEGER PRIMARY KEY
                         REFERENCES member (id_user) ON DELETE CASCADE,
    verification verification_state    DEFAULT ('Pending') 
                         NOT NULL,
    website      TEXT
);

-- Table: personal
DROP TABLE IF EXISTS personal;

CREATE TABLE personal (
    id_member INTEGER PRIMARY KEY
                    REFERENCES Member (id_user) ON DELETE CASCADE
);


-- Table: banned_business
DROP TABLE IF EXISTS banned_business;

CREATE TABLE banned_business (
    id_business INTEGER REFERENCES business (id_member) ON DELETE CASCADE
                      PRIMARY KEY
);


-- Table: banned_personal
DROP TABLE IF EXISTS banned_personal;

CREATE TABLE banned_personal (
    id_personal INTEGER PRIMARY KEY
                      REFERENCES personal (id_member) ON DELETE CASCADE
);


-- Table: comment
DROP TABLE IF EXISTS comment;

CREATE TABLE comment (
    id_comment        INTEGER      PRIMARY KEY,
    text              VARCHAR (50) NOT NULL,
    id_post           INTEGER      NOT NULL
                                   REFERENCES post (id_post) ON DELETE CASCADE,
    id_parent_comment INTEGER      REFERENCES comment (id_comment) ON DELETE CASCADE
                                   NOT NULL,
    CONSTRAINT type_comment CHECK ( (id_post IS NOT NULL) OR (id_parent_comment IS NOT NULL)) 
                                 
);


-- Table: file
DROP TABLE IF EXISTS file;

CREATE TABLE file (
    id_file INTEGER PRIMARY KEY,
    name    VARCHAR NOT NULL,
    id_post INTEGER NOT NULL
                    REFERENCES post (id_post) ON DELETE CASCADE
);


-- Table: follow
DROP TABLE IF EXISTS follow;

CREATE TABLE follow (
    id_user1 INTEGER REFERENCES personal (id_member) ON DELETE CASCADE,
    id_user2 INTEGER REFERENCES member (id_user) ON DELETE CASCADE,
    PRIMARY KEY (
        id_user1,
        id_user2
    )
);


-- Table: invite
DROP TABLE IF EXISTS invite;

CREATE TABLE invite (
    id_inviter INTEGER REFERENCES personal (id_member) ON DELETE CASCADE,
    id_invitee INTEGER REFERENCES personal (id_member) ON DELETE CASCADE,
    id_event   INTEGER REFERENCES event (id_event) ON DELETE CASCADE,
    PRIMARY KEY (
        id_inviter,
        id_invitee,
        id_event
    )
);


-- Table: report
DROP TABLE IF EXISTS report;

CREATE TABLE report (
    id_report INTEGER      PRIMARY KEY,
    reason    VARCHAR (50) NOT NULL,
    veridict  report_state DEFAULT ('Pending') 
                           NOT NULL
);


-- Table: judge_report
DROP TABLE IF EXISTS judge_report;

CREATE TABLE judge_report (
    id_report INTEGER REFERENCES report (id_report) ON DELETE CASCADE,
    id_admin  INTEGER REFERENCES admin (id_user) ON DELETE CASCADE,
    PRIMARY KEY (
        id_report,
        id_admin
    )
);


-- Table: poll
DROP TABLE IF EXISTS poll;

CREATE TABLE poll (
    id_poll INTEGER PRIMARY KEY,
    id_post INTEGER REFERENCES post (id_post) ON DELETE CASCADE
                    NOT NULL
);


-- Table: poll_option
DROP TABLE IF EXISTS poll_option;

CREATE TABLE poll_option (
    id_poll_option INTEGER      PRIMARY KEY,
    name           VARCHAR (20) NOT NULL,
    id_poll        INTEGER      REFERENCES poll (id_poll) ON DELETE CASCADE
                                NOT NULL
);


-- Table: report_event
DROP TABLE IF EXISTS report_event;

CREATE TABLE report_event (
    id_report   INTEGER PRIMARY KEY
                        REFERENCES report (id_report) ON DELETE CASCADE,
    id_reporter INTEGER NOT NULL
                        REFERENCES member (id_user) ON DELETE CASCADE,
    id_event    INTEGER NOT NULL
                        REFERENCES event (id_event) ON DELETE CASCADE
);


-- Table: report_post
DROP TABLE IF EXISTS report_post;

CREATE TABLE report_post (
    id_report   INTEGER PRIMARY KEY
                        REFERENCES report (id_report) ON DELETE CASCADE,
    id_reporter INTEGER NOT NULL
                        REFERENCES member (id_user) ON DELETE CASCADE,
    id_post     INTEGER REFERENCES post (id_post) ON DELETE CASCADE
                        NOT NULL
);


-- Table: report_user
DROP TABLE IF EXISTS report_user;

CREATE TABLE report_user (
    id_report          INTEGER REFERENCES report (id_report) ON DELETE CASCADE
                               PRIMARY KEY,
    id_reporter        INTEGER REFERENCES member (id_user) ON DELETE CASCADE
                               NOT NULL,
    id_reported_member INTEGER REFERENCES member (id_user) ON DELETE CASCADE
                               NOT NULL
);


-- Table: ticket
DROP TABLE IF EXISTS ticket;

CREATE TABLE ticket (
    token           INTEGER PRIMARY KEY,
    id_event        INTEGER REFERENCES event (id_event) ON DELETE CASCADE
                            NOT NULL,
    id_ticket_owner INTEGER REFERENCES personal (id_member) ON DELETE CASCADE
                            NOT NULL
);


-- Table: vote_on_poll
DROP TABLE IF EXISTS vote_on_poll;

CREATE TABLE vote_on_poll (
    id_user        INTEGER REFERENCES member (id_user) ON DELETE CASCADE,
    id_poll_option INTEGER REFERENCES poll_option (id_poll_option) ON DELETE CASCADE,
    PRIMARY KEY (
        id_user,
        id_poll_option
    )
);
