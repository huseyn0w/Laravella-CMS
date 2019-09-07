$(function () {

    var delete_role = $(".delete_role");

    delete_role.on('click', function () {
        var deleted_role_id = $(this).prev('.deleted_role_id').val();
        var that = $(this);

        var delete_confirmation = confirm('Are you sure? Role will be deleted');
        if(delete_confirmation){
            $.ajax({
                url: "/cpanel/roles/" + deleted_role_id + "/delete/",
                type: 'DELETE',
                data: {
                    "id": deleted_role_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data)
                {
                    if(data === "OK")
                    {
                        var message = "Role has been successfully deleted";
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