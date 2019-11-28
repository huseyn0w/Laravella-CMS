$(function(){
    var custom_link_label     = $("#custom_link_label"),
        custom_link_url       = $("#custom_link_url"),
        add_custom_link       = $("#add_custom_link"),
        custom_text_label     = $("#admin_text_label"),
        custom_link_key       = $("#custom_link_key"),
        custom_link_modal     = $("#custom_link_modal"),
        custom_fields_cover   = $("#custom_fields_cover");




    add_custom_link.on("click", function (e) {

        var custom_text_label_value = custom_text_label.val(),
            custom_link_label_value = url_slug(custom_link_label.val()),
            custom_link_url_value = custom_link_url.val(),
            custom_link_key_value = custom_link_key.val(),
            open_in_new_tab = 0;

        if(custom_link_label_value !== "" && custom_link_url_value !== ""){

            var   form_input = `
           <div class="row inputRow">
              <div class="col-md-12">
                   <div class="form-group custom-form-group">
                       <label>${custom_text_label_value}</label>
                       <div class="form-group custom-form-group">
                           <label>${link_label}</label>
                           <input type="text" class="form-control" name="custom_fields[${custom_link_key_value}][value][label]" value="${custom_link_label_value}">
                       </div>
                       <div class="form-group custom-form-group">
                           <label>${link_url}</label>
                           <input type="text" class="form-control" name="custom_fields[${custom_link_key_value}][value][url]" value="${custom_link_url_value}">
                       </div>
                       <div class="form-group custom-form-group form-check">
                            <label class="form-check-label form-checkbox" for="${custom_link_key_value}"> ${link_target}
                                <input type="checkbox" id="${custom_link_key_value}" class="form-check-input exist-input-checkbox pages-checkbox-input form-tab" ${open_in_new_tab === "1" ? 'checked' : null}>
                                <span class="form-check-sign"></span>
                            </label>
                            <input name="custom_fields[${custom_link_key_value}][value][target]" type="hidden"  class="checkbox-link-value"  value="${open_in_new_tab} ">
                        </div>
                       <input type="hidden" name="custom_fields[${custom_link_key_value}][type]" value="link">
                       <input type="hidden" name="custom_fields[${custom_link_key_value}][admin_label]" value="${custom_text_label_value}">
                       <button type="button" class="remove_field">X</button>
                   </div>
               </div>
           </div>
          `;
            custom_fields_cover.append(form_input);

            custom_link_modal.modal('hide');

            custom_link_label.val("");

            custom_link_url.val("");
        }







    });


    $(document).on("click", ".exist-input-checkbox", function(){
        if($(this).is(':checked')){
            $(this).parent().parent().find(".checkbox-link-value").val("1");
        }
        else{
            $(this).parent().parent().find(".checkbox-link-value").val("0");
        }

    });






});