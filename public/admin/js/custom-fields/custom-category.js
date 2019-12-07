$(function(){
    var custom_category_label     = $("#custom_category_label"),
        custom_category_name     = $("#custom_category_name"),
        add_custom_category_text = $("#add_custom_category_text"),
        custom_category_modal     = $("#custom_category_modal"),
        custom_fields_cover   = $("#custom_fields_cover");

    add_custom_category_text.on("click", function (e) {
        var custom_category_label_value = custom_category_label.val(),
            custom_category_name_value = url_slug(custom_category_name.val()),
            categories_array = JSON.parse(categories_list);
        var category_option = "";



        $(categories_array).each(function(idx,el){
            category_option += `<option value='${el.category_id}'>${el.title}</option>`;
        });


        if(custom_category_label_value !== "" && custom_category_name_value !== ""){
            var   form_input = `
           <div class="row inputRow">
              <div class="col-md-12">
                   <div class="form-group custom-form-group">
                       <label><span>${custom_category_label_value}</span>
                           <select name="custom_fields[${custom_category_name_value}][value]" required class="form-control">
                                ${category_option}
                            </select>
                           <input type="hidden" name="custom_fields[${custom_category_name_value}][type]" value="category">
                           <input type="hidden" name="custom_fields[${custom_category_name_value}][admin_label]" value="${custom_category_label_value}">
                       </label>
                       <button type="button" class="remove_field">X</button>
                   </div>
               </div>
           </div>
          `;
            custom_fields_cover.append(form_input);


            custom_category_modal.modal('hide');


            custom_category_label.val("");

            custom_category_name.val("");
        }







    });







});