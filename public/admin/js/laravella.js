$(function(){

    var AllUsersCheckbox    = $("#selectAllUsers"),
        users_checkbox      = $(".users-checkbox-input"),
        delete_user         = $(".delete_user"),
        delete_page         = $(".delete_page"),
        date_time_input     = $("#date_time_picker"),
        editor              = $("#editor"),
        delete_role         = $(".delete_role");


    if(date_time_input.length){
        date_time_input.datepicker({
            'timepicker':true,
            'language': 'en',
            'dateFormat':'yyyy-mm-dd',
            'timeFormat':'hh:ii:00'
        });
    }

    if(editor.length){
        editor.summernote({

            height:300,

        });
    }




    AllUsersCheckbox.on("click", function () {
        AllUsersCheckbox.toggleClass('all-checked');
        users_checkbox.each(function(index,el){

           if(AllUsersCheckbox.hasClass('all-checked')){
               console.log('we are here');
               $(el).attr('checked', 'checked');
           }
           else {
               console.log('we are here2');
               $(el).removeAttr('checked');
           }
        });
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
                         that.remove();
                         showNotification('top','right', message, 'success');
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
                            that.remove();
                            showNotification('top','right', message, 'success');
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


    delete_page.on('click', function () {
        var deleted_role_id = $(this).prev('.deleted_page_id').val();
        var that = $(this);

        var delete_confirmation = confirm('Are you sure? Page will be deleted');
        if(delete_confirmation){
            $.ajax({
                url: "/cpanel/pages/" + deleted_role_id + "/delete/",
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
                        var message = "Page has been successfully deleted";
                        that.closest('tr').fadeOut(1000, function () {
                            that.remove();
                            showNotification('top','right', message, 'success');
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


    function showNotification(from, align, message, messagetype){
        color = Math.floor((Math.random() * 4) + 1);

        if(messagetype === 'success'){
            var icon = 'nc-icon nc-check-2';
        }
        else{
            var icon = 'nc-icon nc-simple-remove';
        }

        $.notify({
            icon: icon,
            message: message

        },{
            type: type[color],
            timer: 4000,
            placement: {
                from: from,
                align: align
            }
        });
    }






});