var like_button = document.querySelector('#like_post'),
    like_count_cover = document.querySelector("#like_count_cover"),
    post_likes_count = like_count_cover.getAttribute('data-likes'),
    post_likes_content = document.querySelector('#post-like-content'),
    like_cover = document.querySelector(".bottom-wrapper");

like_button.addEventListener('click', function(e){




    var data = {
        postId:post_id,
        userId:user_id
    };

    this.setAttribute('disabled', 'disabled');

    fetch(handle_url_likes, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': _token,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        credentials: 'same-origin',
        body: JSON.stringify(data)
    }).then(response => response.json())
    .then(message => {

        if(message === like_added)
        {
            like_cover.classList.add('post_liked');
            like_button.innerText = dislike_post;
            post_likes_count++;
            like_count_cover.setAttribute('data-likes', post_likes_count);

            if(post_likes_count === 1)
            {
                post_likes_content.innerText = you_only_liked;
            }
            else if(post_likes_count > 1)
            {
                post_likes_content.innerText = you_and + post_likes_content.textContent;
            }

        }
        else if(message === like_deleted)
        {
            like_cover.classList.remove('post_liked');
            like_button.innerText = like_post;
            if(post_likes_count >= 0)
            {
                post_likes_count--;
                like_count_cover.setAttribute('data-likes', post_likes_count);
            }

            if(post_likes_count == 0)
            {
                post_likes_content.innerText = nobody_likes;
            }
            else{
                var oldText = post_likes_content.textContent;
                var newText = oldText.replace(you_and, "");
                post_likes_content.innerText = newText;
            }
        }

        like_button.removeAttribute('disabled');
    });


});