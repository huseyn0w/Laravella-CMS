$(function(){
    var custom_image_label       = $("#custom_image_label"),
        custom_image_key         = $("#custom_image_key"),
        custom_input_image_input = $("#thumbnail"),
        custom_image_modal       = $("#custom_image_modal"),
        custom_fields_cover      = $("#custom_fields_cover"),
        add_custom_image         = $("#add_custom_image"),
        lfm                      = $("#lfm"),
        domain                   = site_url + "filemanager";




    lfm.filemanager('image', {prefix: domain});

    add_custom_image.on("click", function (e) {
        var custom_image_label_value = custom_image_label.val(),
            custom_image_key_value = url_slug(custom_image_key.val()),
            custom_input_image_url = custom_input_image_input.val();

        if(custom_image_key_value !== "" && custom_input_image_url !== "" && custom_image_label_value !== ""){
            var   form_input = `
           <div class="row inputRow">
              <div class="col-md-12">
                   <div class="form-group custom-form-group">
                       <label>${custom_image_label_value}</label>
                           <input type="text" required name="custom_fields[${custom_image_key_value}][value]" class="form-control" value="${custom_input_image_url}">
                           <input type="hidden" name="custom_fields[${custom_image_key_value}][type]"  value="image">
                           <input type="hidden" name="custom_fields[${custom_image_key_value}][admin_label]" value="${custom_image_label_value}">
                       <button type="button" class="remove_field">X</button>
                   </div>
               </div>
           </div>
          `;
            custom_fields_cover.append(form_input);


            custom_image_modal.modal('hide');

            custom_image_label.val("");
            custom_image_key.val("");
            custom_input_image_input.val("");
        }







    });







});

