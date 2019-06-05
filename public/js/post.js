let newPostBttn = document.querySelector('#new_post_button');

newPostBttn.addEventListener('click', newPostRequest);

 function newPostRequest() {

  let id_event = document.querySelector('#id_event').innerHTML;

  let post_text = $('#exampleFormControlTextarea1[name=newPost]').val();

  let method = 'post';

  sendAjaxRequest(method, '/api/event/' + id_event + '/newpost', { data: post_text, post_type: 'None'}, newPostRequestHandler);
  
 }

 function newPostRequestHandler() {
    if (this.status == 200) {

        let post = JSON.parse(this.response);

        let container_fluid = document.createElement("div");
        container_fluid.className = "container-fluid actionCard";

        let span = document.createElement("SPAN");
        span.id = "id_post";
        span.style="display:none;"
        span.innerText = post[0].id_post;
        
        let card_comment = document.createElement("div");
        card_comment.className = "card card-comment";

        let description_header = document.createElement("div");
        description_header.className = "description header";

        let img = document.createElement("IMG");
        img.className = "userAction roundRadius";
        img.src = "../img/user.jpg";
        img.alt = "Card image cap";

        let header_text = document.createElement("div");
        header_text.className = "headerText";

        let span2 = document.createElement("SPAN");
        span2.className = "card-title";

        let textNode = document.createTextNode(" posted on ")

        let a = document.createElement("a");
        a.href = "userprofile.html";

        let span3 = document.createElement("SPAN");
        span3.className = "link-username";
        span3.innerText = post[2];

        let a2 = document.createElement("a");
        a2.href = "eventpage.html";

        let span4 = document.createElement("SPAN");
        span4.className = "link-event";
        span4.innerText = post[1];

        let spanDate = document.createElement("SPAN");
        spanDate.className = "card-date";
        spanDate.innerText = post[0].date;

        let card_body = document.createElement("div");
        card_body.className = "card-body";

        let card_text = document.createElement("p");
        card_text.className = "card-text";
        card_text.innerText = post[0].text;

        //TODO

        let footer = document.createElement("div");
        footer.className = "footer px-2";

        let hr = document.createElement("hr");

        let comments1 = document.createElement("div");
        comments1.id = "comments1-".concat(post[0].id_post.toString());
        comments1.className = "comments collapse mb-2 mt-3";
        comments1.setAttribute("data-id", post[0].id_post);

        let commentInput = document.createElement("div");
        commentInput.className = "commentInput row";
        commentInput.setAttribute("data-id", post[0].id_post);

        let col = document.createElement("div");
        col.className = "col px-1";

        let img_userAction = document.createElement("IMG");
        img_userAction.className = "userAction roundRadius";
        img_userAction.src = "../img/user.jpg";
        img_userAction.alt = "Card image cap";

        let textarea_comment = document.createElement("textarea");
        textarea_comment.id = "comment_data";
        textarea_comment.setAttribute("data-id", post[0].id_post);
        textarea_comment.className = "form-control roundRadius pl-5";
        textarea_comment.rows = "1";
        textarea_comment.placeholder = "Say something...";

        let div_col_auth = document.createElement("div");
        div_col_auth.className = "col-auto p-0";

        let button = document.createElement("button");
        button.id = "add comment_button";
        button.className = "commentButton  btn-primary roundRadius";
        button.type = "button";
        button.setAttribute("aria-expanded","false");
        button.setAttribute("data-id", post[0].id_post);

        button.addEventListener('click', addCommentRequest);

        let i = document.createElement("i");
        i.className = "fab fa-font-awesome-flag";

        let comment_section = document.createElement("div");
        comment_section.className = "card-comment-section";
        comment_section.id = "comment_section";
        comment_section.setAttribute("data-id",post[0].id_post);

        let hr_mt = document.createElement("hr");
        hr_mt.className = "mt-4 mx-6";

        let footerText = document.createElement("div");
        footerText.className = "footerText";
        footerText.setAttribute("data-toggle","collapse");
        footerText.setAttribute('href' , "#comments1-".concat(post[0].id_post.toString()));
        footerText.role = "button";
        footerText.setAttribute("aria-expanded","false");
        footerText.setAttribute("aria-controls","collapseExample");

        let button_comment_button = document.createElement("button");
        button_comment_button.id = "comment_button";
        button_comment_button.setAttribute("data-id" , post[0].id_post);
        button_comment_button.addEventListener('click', showCommentsRequest);

        let i2 = document.createElement("i");
        i2.className = "fas fa-caret-right";

        let i3 = document.createElement("i");
        i3.className = "far fa-comments";
        i3.setAttribute("data-id" , post[0].id_post);

        let size_span = document.createElement("SPAN");
        size_span.innerText = 0;

        container_fluid.appendChild(span);
        container_fluid.appendChild(card_comment);
        card_comment.appendChild(description_header);
        description_header.appendChild(img);
        description_header.appendChild(header_text);
        header_text.appendChild(span2);
        span2.appendChild(a);
        span2.appendChild(textNode);
        a.appendChild(span3)
        span2.appendChild(a2);
        a2.appendChild(span4);
        header_text.appendChild(spanDate);
        description_header.appendChild(i);
        card_comment.appendChild(card_body);
        card_body.appendChild(card_text);
        card_comment.appendChild(footer);
        footer.appendChild(hr);
        footer.appendChild(comments1);
        comments1.appendChild(commentInput);
        commentInput.appendChild(col);
        col.appendChild(img_userAction);
        col.appendChild(textarea_comment);
        commentInput.appendChild(div_col_auth);
        div_col_auth.appendChild(button);
        button.appendChild(i2);
        comments1.appendChild(comment_section);
        comments1.appendChild(hr_mt);
        footer.appendChild(footerText);
        footerText.appendChild(button_comment_button);
        button_comment_button.appendChild(i3);
        button_comment_button.appendChild(size_span);

        $('#exampleFormControlTextarea1[name=newPost]').val('');

        let posts_section = document.querySelector('#posts');
        posts_section.appendChild(container_fluid);
      }
 }