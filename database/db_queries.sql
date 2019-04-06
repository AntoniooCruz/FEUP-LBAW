--------------------
-------SELECTS------
--------------------

--Event information: SELECT information FROM event with id = $event_id
SELECT title, date_created, date, location, event.description, price, capacity, isPrivate, users.name AS owner_name, category.name AS category_name, city 
	FROM event,users,category 
	WHERE event.id_owner=users.id_user
	    AND event.id_category=category.id_category
        AND event.id_event = $event_id;

--Account information: SELECT information FROM user with username = $username
--if user.type == personal
SSELECT email, name, description, count(*) as followers, following
	FROM users, follow, (SELECT users.username as username, count(*) as following
												FROM users, follow
												WHERE username = $username
												AND follow.id_user1 = users.id_user
												GROUP BY (users.id_user, email, name,description)
											) as followingQuery
	WHERE users.username = followingQuery.username
	AND follow.id_user2 = users.id_user
	GROUP BY (users.id_user, email, name,description,following);

--else if user.type == business
SELECT email, name, description, verification, website, count(*) as followers
	FROM users, business, follow
	WHERE business.id_user = users.id_user
	AND username = $username
	AND follow.id_user2 = users.id_user
	GROUP BY (business.id_user, email, name,description, verification, website);

--Posts of event: select posts from event with id = $event_id
SELECT username,date, text, file."name", id_poll
	FROM post
	LEFT JOIN file ON file.id_post=post.id_post
	LEFT JOIN poll ON poll.id_post=post.id_post
	LEFT JOIN users ON users.id_user=post.id_author
	WHERE id_event = $event_id;


--Comments of posts: select comments to post with id = $post_id
SELECT username, comment.date, comment.text
	FROM post, "comment", users
		WHERE comment.id_post = post.id_post
			AND users.id_user="comment".id_author
			AND post.id_post=$post_id;

--Replies of comment: select replies to comment with id = $comment_id
SELECT username, reply.date, reply.text
	FROM "comment" parent, "comment" reply, users
		WHERE parent.id_comment = reply.id_parent_comment
		AND parent.id_comment = $comment_id
		AND users.id_user=reply.id_author;            


--Poll Options and votes: select poll options to poll with id = $poll_id and the number of votes in each option
SELECT name, count(*) as n_votes
	FROM poll_option, vote_on_poll
	WHERE id_poll= $poll_id
		AND poll_option.id_poll_option=vote_on_poll.id_poll_option
	GROUP BY name;


--users's tickets: select all tickets of user with username = $username
SELECT token, title, user1.username
 FROM ticket,event, users user1, users user2
 WHERE ticket.id_event=event.id_event
	AND ticket.id_ticket_owner=user1.id_user
	AND user1.username= $username
	AND user2.id_user=event.id_owner;        


--users's invites: select invites of user with username = $username
SELECT user1.username as inviter, user3.username as organizer, event.id_event
	FROM invite,event,users user1,users user2, users user3
	WHERE invite.id_inviter=user1.id_user
      AND invite.id_invitee=user2.id_user
			AND event.id_event = invite.id_event
			AND event.id_owner = user3.id_user
			AND user2.username = $username;


--search
/*events seen by the user with username = $username*/
DROP VIEW IF EXISTS able_to_see_events;

CREATE VIEW able_to_see_events AS
SELECT e1.id_event 
	FROM event e1,users user1, category, users user2
	WHERE e1.id_owner=user1.id_user
	    AND e1.id_category=category.id_category
			AND user2.username = $username
			AND (	isprivate = false
					OR
					(user2.id_user IN (SELECT id_invitee
										FROM invite
										WHERE invite.id_event=e1.id_event
					                )
				    )
				);

    /* ... */            

--reports:

--feed: 

--------------------
-------UPDATE-------
--------------------
--edit event
UPDATE event
  SET title = $title, date = $date, price = $price,capacity = $capacity, isPrivate = $privateBool, id_category=$category, city = $city
  WHERE username = $username; 

--edit profile:
UPDATE users
  SET name = $name, description = $description
  WHERE username = $username; 

--------------------
-------INSERTS------
--------------------
--new user
insert into users (username, email, password) values ( $username, $email, $password, $type);

--new event
insert into event (title, date_created, date, location, description, price, capacity, isPrivate, id_owner, id_category, city) values ($title, $date_created, $date, $location, $description, $price, $capacity, $isPrivate, $id_owner, $id_category, $city);

--new post
insert into post (date, text, id_event, id_author) values ($date, $text, $id_event, $id_author);
insert into file (name, id_post) VALUES ($name, $id_post);
insert into poll (id_post) VALUES ($id_post);
insert into poll_option (name, id_poll) VALUES ($name, $id_poll);

--new comment
insert into comment (text, id_post, id_parent_comment, id_author, date) values ($text, $id_post, $id_parent_comment, $id_author, $date);

--new ticket
insert into ticket (id_event,id_ticket_owner) VALUES ($id_event, $id_ticket_owner);

--new invite
insert into invite (id_inviter, id_invitee, id_event) VALUES ($id_inviter, $id_invitee, $id_event);

--new follow
insert into follow (id_user1, id_user2) values ($id_user1, $id_user2);

--vote on poll
insert into vote_on_poll (id_user, id_poll_option) VALUES ($id_user, $id_poll_option);

--new report
insert into report (reason, veridict, report_type) values ($reason, $veridict, $report_type);

insert into report_event (id_report, id_reporter, id_event) values ($id_report, $id_reporter, $id_event);
insert into report_post (id_report, id_reporter, id_post) values ($id_report, $id_reporter, $id_post);
insert into report_user (id_report, id_reporter, id_reported_user) values ($id_report, $id_reporter, $id_event);

--------------------
-------DELETES------
--------------------