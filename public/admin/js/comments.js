$(function(){

    var AllComments            = $("#selectAll"),
        comments_checkbox      = $(".comments-checkbox-input"),
        delete_comment         = $(".delete_comment"),
        approve_comment        = $(".approve_comment"),
        unapprove_comment      = $(".unapprove_comment");



    AllComments.on("click", function () {
        AllComments.toggleClass('all-checked');
        comments_checkbox.each(function(index,el){

            if(AllComments.hasClass('all-checked')){
                $(el).prop('checked', 'checked');
            }
            else {
                $(el).prop('checked', false);
            }
        });
    });

    comments_checkbox.on('click', function () {
        console.log('salam');
        if(!$(this).prop('checked')){
            AllComments.removeClass('all-checked');
            AllComments.prop('checked', false);
        }
    });


    delete_comment.on('click', function () {

        var deleted_comment_id = $(this).parent().find(".action_comment_id").val();

        console.log(deleted_comment_id);
        var that = $(this);

        var delete_confirmation = confirm('Are you sure? Comment will be deleted');
        if(delete_confirmation){

            $.ajax({
                url: "/cpanel/comments/" + deleted_comment_id + "/delete/",
                type: 'DELETE',
                data: {
                    "id": deleted_comment_id
                },
                headers: {
                    'X-CSRF-TOKEN':_token
                },
                success: function (data)
                {
                    if(data === "OK")
                    {
                        var message = "Comment has been successfully deleted";
                        that.closest('tr').fadeOut(1000, function () {
                            that.closest('tr').remove();
                            showNotification('top','right', message, 'success', 2);
                        });
                    }
                    else{
                        var message = data;
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


    approve_comment.on('click', function () {

        var approved_comment_id = $(this).parent().find(".action_comment_id").val();

        var that = $(this);

        var approve_confirmation = confirm('Are you sure? Comment will be approved');
        if(approve_confirmation){

            $.ajax({
                url: "/cpanel/comments/" + approved_comment_id + "/approve/",
                type: 'PUT',
                data: {
                    "id": approved_comment_id
                },
                headers: {
                    'X-CSRF-TOKEN': _token
                },
                success: function (data)
                {
                    if(data === "OK")
                    {
                        var message = "Comment has been successfully approved";
                        showNotification('top','right', message, 'success', 2);
                        that.hide().remove();
                    }
                    else{
                        var message = data;
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

    unapprove_comment.on('click', function () {

        var unapproved_comment_id = $(this).parent().find(".action_comment_id").val();

        var that = $(this);

        var approve_confirmation = confirm('Are you sure? Comment will be approved');
        if(approve_confirmation){

            $.ajax({
                url: "/cpanel/comments/" + unapproved_comment_id + "/unapprove/",
                type: 'PUT',
                data: {
                    "id": unapproved_comment_id
                },
                headers: {
                    'X-CSRF-TOKEN': _token
                },
                success: function (data)
                {
                    if(data === "OK")
                    {
                        var message = "Comment has been successfully unapproved";
                        showNotification('top','right', message, 'success', 2);
                        that.hide().remove();
                    }
                    else{
                        var message = data;
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
})