$(function () {

    var AllUsersCategories       = $("#selectAll"),
        categories_checkbox      = $(".categories-checkbox-input"),
        delete_category          = $(".delete_category");


    AllUsersCategories.on("click", function () {
        AllUsersCategories.toggleClass('all-checked');
        categories_checkbox.each(function(index,el){

            if(AllUsersCategories.hasClass('all-checked')){
                $(el).attr('checked', 'checked');
            }
            else {
                $(el).removeAttr('checked');
            }
        });
    });

    delete_category.on('click', function () {
        var deleted_category_id = $(this).prev('.deleted_category_id').val();
        var that = $(this);

        var delete_confirmation = confirm('Are you sure? Category will be deleted');
        if(delete_confirmation){
            $.ajax({
                url: "/cpanel/categories/" + deleted_category_id + "/delete/",
                type: 'DELETE',
                data: {
                    "id": deleted_category_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data)
                {
                    if(data === "OK")
                    {
                        var message = "Category has been successfully deleted";
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