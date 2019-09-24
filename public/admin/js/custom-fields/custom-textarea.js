$(function(){
    var custom_textarea_label     = $("#custom_textarea_label"),
        custom_textarea_name     = $("#custom_textarea_name"),
        add_custom_textarea_input = $("#add_custom_textarea_input"),
        custom_textarea_modal     = $("#custom_textarea_modal"),
        custom_fields_cover   = $("#custom_fields_cover");

    add_custom_textarea_input.on("click", function (e) {
        var custom_text_label_value = custom_textarea_label.val(),
            custom_text_name_value = url_slug(custom_textarea_name.val());

        if(custom_text_label_value !== "" && custom_text_name_value !== ""){
            var   form_input = `
           <div class="row inputRow">
              <div class="col-md-12">
                   <div class="form-group custom-form-group">
                       <label>${custom_text_label_value}
                           <textarea name="custom_fields[${custom_text_name_value}]" class="form-control my-editor" value=""></textarea>
                       </label>
                       <button type="button" class="remove_field">X</button>
                   </div>
               </div>
           </div>
          `;
            custom_fields_cover.append(form_input);

            var editor_config = {
                path_absolute : "/",
                height : "150",
                selector: "textarea.my-editor",
                plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                relative_urls: false,
                file_browser_callback : function(field_name, url, type, win) {
                    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                    var cmsURL = editor_config.path_absolute + 'filemanager?field_name=' + field_name;
                    if (type == 'image') {
                        cmsURL = cmsURL + "&type=Images";
                    } else {
                        cmsURL = cmsURL + "&type=Files";
                    }

                    console.log('cmsURL');

                    tinyMCE.activeEditor.windowManager.open({
                        file : cmsURL,
                        title : 'Filemanager',
                        width : x * 0.8,
                        height : y * 0.8,
                        resizable : "yes",
                        close_previous : "no"
                    });
                }
            };

            tinymce.init(editor_config);


            custom_textarea_modal.modal('hide');


            custom_textarea_label.val("");

            custom_textarea_name.val("");
        }







    });







});