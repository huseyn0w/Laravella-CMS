$(function(){
    var lfm            = $("#lfm"),
        post_thumbnail = $(".post-thumbnail"),
        domain         = site_url + "filemanager";




    lfm.filemanager('image', {prefix: domain});

    post_thumbnail.on('click', function(){
        $("input#thumbnail").val('');
        $("#post-thumbnail").hide().attr('src', '');
        $(this).hide();
    });

});