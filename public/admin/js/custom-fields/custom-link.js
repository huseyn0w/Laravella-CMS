$(function(){
    var custom_link_label     = $("#custom_link_label"),
        custom_link_url       = $("#custom_link_url"),
        add_custom_link       = $("#add_custom_link"),
        custom_link_new_tab   = $("#custom_link_new_tab"),
        custom_link_key       = $("#custom_link_key"),
        custom_link_modal     = $("#custom_link_modal"),
        custom_fields_cover   = $("#custom_fields_cover");




    add_custom_link.on("click", function (e) {

        var custom_link_label_value = url_slug(custom_link_label.val()),
            custom_link_url_value = custom_link_url.val(),
            custom_link_key_value = custom_link_key.val(),
            open_in_new_tab = 0;

        if(custom_link_label_value !== "" && custom_link_url_value !== ""){

            if (custom_link_new_tab.is(":checked"))
            {
                open_in_new_tab = 1;
            }

            var   form_input = `
           <div class="row inputRow">
              <div class="col-md-12">
                   <div class="form-group custom-form-group">
                       <p>Link URL: ${custom_link_url_value} </p>
                       <p>Link Label: ${custom_link_label_value} </p>
                       <p>Open in new tab: ${open_in_new_tab === 1 ? 'Yes' : 'No'} </p>
                       <input type="hidden" name="custom_fields[${custom_link_key_value}]['label']" value="${custom_link_label_value}">
                       <input type="hidden" name="custom_fields[${custom_link_key_value}]['url']" value="${custom_link_url_value}">
                       <input type="hidden" name="custom_fields[${custom_link_key_value}]['target']" value="${open_in_new_tab}">
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







});