$(function () {

    var AllPages            = $("#selectAll"),
        pages_checkbox      = $(".pages-checkbox-input"),
        delete_page         = $(".delete_page");


    AllPages.on("click", function () {
        AllPages.toggleClass('all-checked');
        pages_checkbox.each(function(index,el){

            if(AllPages.hasClass('all-checked')){
                $(el).attr('checked', 'checked');
            }
            else {
                $(el).removeAttr('checked');
            }
        });
    });

    delete_page.on('click', function () {
        var deleted_page_id = $(this).prev('.deleted_page_id').val();
        var that = $(this);

        var delete_confirmation = confirm('Are you sure? Page will be deleted');
        if(delete_confirmation){
            $.ajax({
                url: "/cpanel/pages/" + deleted_page_id + "/delete/",
                type: 'DELETE',
                data: {
                    "id": deleted_page_id
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