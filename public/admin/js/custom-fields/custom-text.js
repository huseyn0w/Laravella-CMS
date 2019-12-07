$(function(){
    var custom_text_label     = $("#custom_text_label"),
        custom_input_name     = $("#custom_input_name"),
        add_custom_input_text = $("#add_custom_input_text"),
        custom_text_modal     = $("#custom_text_modal"),
        custom_fields_cover   = $("#custom_fields_cover");

    add_custom_input_text.on("click", function (e) {
       var custom_text_label_value = custom_text_label.val(),
           custom_text_name_value = url_slug(custom_input_name.val());

       if(custom_text_label_value !== "" && custom_text_name_value !== ""){
           var   form_input = `
           <div class="row inputRow">
              <div class="col-md-12">
                   <div class="form-group custom-form-group">
                       <label>${custom_text_label_value}</label>
                       <input type="text" name="custom_fields[${custom_text_name_value}][value]" required class="form-control">
                       <input type="hidden" name="custom_fields[${custom_text_name_value}][type]" value="text">
                       <input type="hidden" name="custom_fields[${custom_text_name_value}][admin_label]" value="${custom_text_label_value}">
                       <button type="button" class="remove_field">X</button>
                   </div>
               </div>
           </div>
          `;
           custom_fields_cover.append(form_input);


           custom_text_modal.modal('hide');


           custom_text_label.val("");

           custom_input_name.val("");
       }







    });







});