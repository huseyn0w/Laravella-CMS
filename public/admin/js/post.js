$(function () {

    var AllPosts            = $("#selectAll"),
        posts_checkbox      = $(".posts-checkbox-input"),
        delete_post         = $(".delete_post");
        destroy_post         = $(".destroy_post");


    AllPosts.on("click", function () {
        AllPosts.toggleClass('all-checked');
        posts_checkbox.each(function(index,el){

            if(AllPosts.hasClass('all-checked')){
                $(el).prop('checked', 'checked');
            }
            else {
                $(el).prop('checked', false);
            }
        });
    });

    posts_checkbox.on('click', function () {
        if(!$(this).prop('checked')){
            AllPosts.removeClass('all-checked');
            AllPosts.prop('checked', false);
        }
    });

    delete_post.on('click', function () {
        var deleted_post_id = $(this).prev('.deleted_post_id').val();
        var that = $(this);

        var delete_confirmation = confirm('Are you sure? Post will be deleted');
        if(delete_confirmation){
            $.ajax({
                url: "/cpanel/posts/" + deleted_post_id + "/delete/",
                type: 'DELETE',
                data: {
                    "id": deleted_post_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data)
                {
                    if(data === "OK")
                    {
                        var message = "Post has been successfully deleted";
                        that.closest('tr').fadeOut(1000, function () {
                            that.closest('tr').remove();
                            showNotification('top','right', message, 'success', 2);
                        });
                    }
                    else{
                        var message = "Error has been occured. Please try again later";
                        showNotification('top','right', message, 'error');
                    }
                },
                error:function(data)
                {
                    var message = data;
                    showNotification('top','right', message, 'error');
                }
            });

        }
    });


    destroy_post.on('click', function () {
        var deleted_post_id = $(this).prev('.deleted_post_id').val();
        var that = $(this);

        var delete_confirmation = confirm('Are you sure? Post will be deleted');
        if(delete_confirmation){
            $.ajax({
                url: "/cpanel/posts/" + deleted_post_id + "/destroy/",
                type: 'DELETE',
                data: {
                    "id": deleted_post_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data)
                {
                    if(data === "OK")
                    {
                        var message = "Post has been successfully deleted";
                        that.closest('tr').fadeOut(1000, function () {
                            that.closest('tr').remove();
                            showNotification('top','right', message, 'success', 2);
                        });
                    }
                    else{
                        var message = "Error has been occured. Please try again later";
                        showNotification('top','right', message, 'error');
                    }
                },
                error:function(data)
                {
                    var message = data;
                    showNotification('top','right', message, 'error');
                }
            });

        }
    });

});