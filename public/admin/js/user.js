$(function () {

    var AllUsersCheckbox    = $("#selectAll"),
        users_checkbox      = $(".users-checkbox-input"),
        delete_user         = $(".delete_user");

    AllUsersCheckbox.on("click", function () {
        AllUsersCheckbox.toggleClass('all-checked');
        users_checkbox.each(function(index,el){

            if(AllUsersCheckbox.hasClass('all-checked')){
                $(el).prop('checked', 'checked');
            }
            else {
                $(el).prop('checked', false);
            }
        });
    });

    users_checkbox.on('click', function () {
        if(!$(this).prop('checked')){
            AllUsersCheckbox.removeClass('all-checked');
            AllUsersCheckbox.prop('checked', false);
        }
    });


    delete_user.on('click', function () {
        var deleted_user_id = $(this).prev('.deleted_user_id').val();
        var that = $(this);

        var delete_confirmation = confirm('Are you sure? User will be deleted');
        if(delete_confirmation){
            $.ajax({
                url: "/cpanel/users/" + deleted_user_id + "/delete/",
                type: 'DELETE',
                data: {
                    "id": deleted_user_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data)
                {
                    if(data === "OK")
                    {
                        var message = "User has been successfully deleted";
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