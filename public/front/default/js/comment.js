var reply_button = document.querySelectorAll(".reply-to-comment"),
    comment_field = document.querySelector("#comment-field"),
    edit_comment_field = document.querySelector("#comment-update-field"),
    updated_comment_id_field = document.querySelector("#updated_comment_id"),
    updated_comment_author_id_field = document.querySelector("#updated_comment_author_id"),
    input_id = document.querySelector("#comment_parent_id");



document.addEventListener('click', function (event) {
    // If the clicked element doesn't have the right selector, bail
    if (!event.target.matches('.reply-to-comment')) return;

    let comment_parent_id = event.target.getAttribute('data-comment_id'),
        user_name = event.target.getAttribute('data-username');
    input_id.value = comment_parent_id;
    comment_field.value = user_name + ', ';

    document.getElementById("comment-area").scrollIntoView( {behavior: "smooth" })


}, false);


document.addEventListener('click', function (event) {
    // If the clicked element doesn't have the right selector, bail
    if (!event.target.matches('.delete-comment')) return;

    var delete_confirmation = confirm('Comment will be deleted, are you sure?');

    if(delete_confirmation){
        let comment_id = event.target.getAttribute('data-comment_id'),
            user_name = event.target.getAttribute('data-username');

        var data = {
            commentId:comment_id,
            username:user_name
        };



        fetch(handle_url_comments, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': _token,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            credentials: 'same-origin',
            body: JSON.stringify(data)
        }).then(response => response.json())
            .then(message => {
                if(message === "Comment has been deleted")
                {
                    let button_cover = event.target.closest(".comment-list");
                    if(button_cover.nextElementSibling && button_cover.nextElementSibling.classList.contains('comment-replies')){
                        button_cover.nextElementSibling.remove();
                    }
                    button_cover.remove();
                }
                else
                {
                    console.log(message);
                }

               // like_button.removeAttribute('disabled');
            });
    }


}, false);


document.addEventListener('click', function (event) {
    // If the clicked element doesn't have the right selector, bail
    if (!event.target.matches('.edit-comment')) return;

    let comment_id = event.target.getAttribute('data-comment_id'),
       // comment_author_id = event.target.getAttribute('data-author'),
        old_comment = event.target.getAttribute('data-comment');

    edit_comment_field.value = old_comment;
    updated_comment_id_field.value = comment_id;
    updated_comment_author_id_field.value = comment_author_id;

}, false);