(function( $ ){

  $.fn.filemanager = function(type, options) {
    type = type || 'file';

    this.on('click', function(e) {
      var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
      localStorage.setItem('target_input', $(this).data('input'));
      localStorage.setItem('target_preview', $(this).data('preview'));
      window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
      window.SetUrl = function (url, file_path) {
          //set the value of the desired input to image url
          var modified_site_url = site_url.slice(0, -1);
          var target_input = $('#' + localStorage.getItem('target_input'));
          target_input.val(modified_site_url + file_path).trigger('change');

          //set or change the preview image src
          var target_preview = $('#' + localStorage.getItem('target_preview'));
          target_preview.attr('src', url).trigger('change');


          if($(".post-thumbnail").length > 0){

              $("#post-thumbnail").attr('src', url).show(100, function(){
                  $(".post-thumbnail").fadeIn();
              });

          }

          if($("#file-image").length > 0){
              $("#file-image").attr('src', url);
              $("#file-upload").val(url);
          }
      };
      return false;
    });
  }

})(jQuery);
