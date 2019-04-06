--Event information: SELECT information FROM event with id = $event_id
SELECT title, date_created, date, location, event.description, price, capacity, isPrivate, users.name AS owner_name, category.name AS category_name, city 
	FROM event,users,category 
	WHERE event.id_owner=users.id_user
	    AND event.id_category=category.id_category
        AND event.id_event = $event_id;

--Account information: SELECT information FROM user with username = $username
SELECT email, name, active, verification, website
	FROM users
	FULL JOIN business ON users.id_user=business.id_user
	WHERE username = $username;


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