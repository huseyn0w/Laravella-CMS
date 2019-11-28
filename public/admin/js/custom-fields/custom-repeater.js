$(function(){
    var custom_repeater         = $("#custom_repeater"),
        group_count             = 0,
        field_count             = 0,
        add_repeater_field      = $("#add_repeater_field"),
        insert_repeater_fields  = $("#insert_repeater_fields"),
        custom_repeater_buttons = $("#custom_repeater_buttons"),
        custom_repeater_cover   = $("#custom_repeater_cover"),
        custom_fields_cover     = $("#custom_fields_cover"),
        editor_config = {
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


    custom_repeater.on("click", function (e) {
        group_count++;

        var repeater_key = `
            <div class="row custom-repeater-group-key">
               <div class="col-md-12">
                    <div class="form-group label-group">
                        <label>${repeater_headline}</label>
                        <input type="text" required="" class="form-control custom-repeater-headline-name" name="custom-repeater-headline-name_${group_count}">
                    </div>
               </div>
               <div class="col-md-12">
                    <div class="form-group label-group">
                        <label>${repeater_cover_key}</label>
                        <input type="text" required="" class="form-control custom-repeater-key-name" name="custom-repeater-key-name_${group_count}">
                    </div>
               </div>
           </div>
        `;

        custom_repeater_cover.append(repeater_key);

        custom_repeater_cover.show();
        custom_repeater_buttons.show();


    });

    $(document).on("change", ".choose_field", function(){

       var select_value = $(this).val();
       $(this).next('.repeater-group-content').html("");

       var this_select = $(this);

       createField(this_select, select_value);

    });


    add_repeater_field.on("click",  function () {
        field_count++;
        var repeater_select = `
        <div class="form-group repeater-group" id="repeater_group_${field_count}">
            <label for="choose_field_${field_count}">${field_type}</label>
            <select name="choose_field_${field_count}" id="choose_field_${field_count}" class="form-control choose_field">
                <option value="">${field_type_preview}</option>
                <option value="text">${field_text}</option>
                <option value="textarea">${field_textarea}</option>
                <option value="image">${field_image}</option>
                <option value="link">${field_link}</option>
            </select>
            <div class="repeater-group-content"></div>
            <button type="button" class="remove_repeater_field">X</button>
        </div>
        `;
        custom_repeater_cover.append(repeater_select);
    });


    function createField(select,type){
        var   form_input = `
           <div class="row custom-repeater-group-row" data-type="${type}">
               <div class="col-md-12">
                    <div class="form-group label-group">
                        <label>${text_label}</label>
                        <input type="text" required="" class="form-control custom-label" name="input_label_${field_count}">
                    </div>
               </div>
               <div class="col-md-12">
                    <div class="form-group">
                        <label>${text_name}</label>
                        <input type="text" required="" class="form-control custom-input-name" name="input_name_${field_count}">
                    </div>
               </div>
           </div>
          `;


        $(select).next(".repeater-group-content").append(form_input);
    }


    $(document).on('click', ".choose-image", function () {
        var domain = site_url + "filemanager";
        $(this).filemanager('image', {prefix: domain});
    });

    $(document).on('click', ".remove_repeater_field", function () {
        $(this).closest('.repeater-group').remove();
    });

    $(document).on('click', ".toogleGroup", function () {
        $(this).parent().parent().find('.repeater_content_cover').slideToggle();
    });

    $(document).on('click', ".deleteGroup", function () {
        var delete_confirming = confirm(group_delete_conf);
        if(delete_confirming) {
            $(this).closest(".repeater_cover").hide().remove();
        }
    });

    $(document).on('click', ".remove_item", function () {
        $(this).closest('.repeater_content_cover').hide().remove();
        if($(".repeater_content_cover").length <= 0){
            $(this).closest(".repeater_cover").hide().remove();
            $(".duplicate_group").hide().remove();
        }
    });

    $(document).on('click', ".duplicate_group", function () {

        tinymce.remove();

        var cloned_item = $(this).parents().find('.repeater_content_cover').last().clone();

        console.log(cloned_item);

        var row_count = $(cloned_item).find('.inputRow').data('row');
        row_count++;
        $(cloned_item).find('.inputRow').attr('data-row', row_count);


        cloned_item.find('.inputRow').each(function(index,el){
            var key = $(el).data('key');
            var name = $(el).data('name');
            var type = $(el).data('type');




            if($(el).find(".my-editor")){
                $(el).find('.my-editor').attr('id', `custom_fields[${key}][value][row-${row_count}][${name}][value]`);
            }
            if($(el).find(".form-type")){
                $(el).find('.form-type').attr('name', `custom_fields[${key}][value][row-${row_count}][${name}][type]`);
            }

            $(el).find(".duplicate_group").remove();



            if(type === "text" || type === "textarea"){
                $(el).find('.form-control').attr('name', `custom_fields[${key}][value][row-${row_count}][${name}][value]`);
                $(el).find('.form-control').val("");
            }
            else if(type === "link"){
                $(el).find('.form-label').attr('name', `custom_fields[${key}][value][row-${row_count}][${name}][value][label]`);
                $(el).find('.form-label').val("");
                $(el).find('.form-url').attr('name', `custom_fields[${key}][value][row-${row_count}][${name}][value][url]`);
                $(el).find('.form-url').val("");
                $(el).find('.checkbox-link-value').attr('name', `custom_fields[${key}][value][row-${row_count}][${name}][value][target]`);
                $(el).find('.checkbox-link-value').val("");
                $(el).find('.form-check-label').attr("for", key + '_' + row_count);
                $(el).find('.pages-checkbox-input').attr("id", key + '_' + row_count);
                $(el).find('.form-type').attr("name", `custom_fields[${key}][value][row-${row_count}][${name}][type]`);
            }
            else if(type === "image"){
                $(el).find('.form-control').attr('name', `custom_fields[${key}][value][row-${row_count}][${name}][value]`);
                $(el).find('.choose-image').attr('data-input', `thumbnail_${row_count}`);
                $(el).find('.form-image').attr('id', `thumbnail_${row_count}`);
                $(el).find('.form-image').val("");
            }

            $(el).find('.form-admin-label').attr("name", `custom_fields[${key}][value][row-${row_count}][${name}][admin_label]`);



        });

        setTimeout(function() {
            tinymce.init(editor_config);
        }, 50);



        $(this).before(cloned_item);
    });



    insert_repeater_fields.on("click", function(){

        var repeater_key   = url_slug($('.custom-repeater-key-name').val()),
            group_headline = $(".custom-repeater-headline-name").val();



        if(repeater_key !== "" && group_headline !== "" && $(".custom-repeater-group-row").length > 0){

            var repeater_group = `<div class="repeater_cover repeater_${group_count}_cover">
                    <div class="group_headline">
                        <h4>${group_headline}</h4>
                        <button type="button" class="btn btn-danger deleteGroup">${delete_group_label}</button>
                        <button type="button" class="btn btn-info toogleGroup">${toggle_group_label}</button>
                        <input type="hidden" name="custom_fields[${repeater_key}][type]" value="repeater">
                        <input type="hidden" name="custom_fields[${repeater_key}][admin_label]" value="${group_headline}">
                    </div>
                    <div class="repeater_content_cover">
                        <div class="repeater_item">
    
            `;



            $(".custom-repeater-group-row").each(function(index,el){
                var type = $(el).data('type');


                switch (type) {
                    case "text":
                        repeater_group += insertTextField(el, repeater_key);
                        break;
                    case "textarea":
                        repeater_group += insertTextareaField(el, repeater_key);
                        break;
                    case "image":
                        repeater_group += insertImageField(el, repeater_key);
                        break;
                    case "link":
                        repeater_group += insertLinkField(el, repeater_key);
                        break;
                    default:
                        return;
                }

            });

            repeater_group += '<button type="button" class="btn btn-danger remove_item">'+ delete_row +'</button>';


            repeater_group += '</div></div><button type="button" class="btn btn-info duplicate_group">'+ add_row +'</button></div>';

            custom_fields_cover.append(repeater_group);



            tinymce.init(editor_config);


            field_count = 0;
            custom_repeater_cover.html("");
            custom_repeater_cover.hide();
            custom_repeater_buttons.hide();

        }


    });


    function insertTextField(el, repeater_key){

        var custom_text_label_value = $(el).find(".custom-label").val(),
            custom_text_name_value = url_slug($(el).find(".custom-input-name").val());

        var form_input = `
                <div class="row inputRow" data-type="text" data-key="${repeater_key}" data-row="0" data-name="${custom_text_name_value}">
                  <div class="col-md-12">
                       <div class="form-group custom-form-group">
                           <label>${custom_text_label_value}</label>
                           <input type="text" name="custom_fields[${repeater_key}][value][row-0][${custom_text_name_value}][value]" class="form-control" value="">
                           <input type="hidden" name="custom_fields[${repeater_key}][value][row-0][${custom_text_name_value}][type]" class="form-type" value="text">
                           <input type="hidden" class="form-admin-label" name="custom_fields[${repeater_key}][value][row-0][${custom_text_name_value}][admin_label]" value="${custom_text_label_value}">
                       </div>
                   </div>
                </div>
            `;

        return form_input;
    }


    function insertTextareaField(el, repeater_key){
        var custom_text_label_value = $(el).find(".custom-label").val(),
            custom_text_name_value = url_slug($(el).find(".custom-input-name").val());

        var form_input = `
                <div class="row inputRow" data-type="textarea" data-key="${repeater_key}" data-row="0" data-name="${custom_text_name_value}">
                  <div class="col-md-12">
                       <div class="form-group custom-form-group">
                           <label>${custom_text_label_value}</label>
                           <textarea name="custom_fields[${repeater_key}][value][row-0][${custom_text_name_value}][value]" class="form-control my-editor"></textarea>
                           <input type="hidden" name="custom_fields[${repeater_key}][value][row-0][${custom_text_name_value}][type]" class="form-type" value="textarea">
                           <input type="hidden" class="form-admin-label" name="custom_fields[${repeater_key}][value][row-0][${custom_text_name_value}][admin_label]" value="${custom_text_label_value}">
                       </div>
                   </div>
               </div>
            `;



        return form_input;
    }



    function insertLinkField(el, repeater_key){
        var custom_text_label_value = $(el).find(".custom-label").val(),
            custom_text_name_value = url_slug($(el).find(".custom-input-name").val());

        var   form_input = `
           <div class="row inputRow" data-type="link" data-key="${repeater_key}" data-row="0" data-name="${custom_text_name_value}">
              <div class="col-12">
                <p>${custom_text_label_value}</p>
              </div>
              <div class="col-md-12">
                   <div class="form-group custom-form-group">
                       <label>${link_label}</label>
                       <input type="text" class="form-control form-label" name="custom_fields[${repeater_key}][value][row-0][${custom_text_name_value}][value][label]">
                   </div>
                   <div class="form-group custom-form-group">
                       <label>${link_url}</label>
                       <input type="text" class="form-control form-url" name="custom_fields[${repeater_key}][value][row-0][${custom_text_name_value}][value][url]" value="">
                   </div>
                   <div class="form-group custom-form-group form-check">
                        <label class="form-check-label form-checkbox" for="${repeater_key}"> ${link_target}
                            <input id="${repeater_key}" class="form-check-input pages-checkbox-input form-tab exist-input-checkbox pages-checkbox-input" type="checkbox">
                            <span class="form-check-sign"></span>
                        </label>
                        <input name="custom_fields[${repeater_key}][value][row-0][${custom_text_name_value}][value][target]" type="hidden"  class="checkbox-link-value" value="0">
                        <input type="hidden" class="form-type" name="custom_fields[${repeater_key}][value][row-0][${custom_text_name_value}][type]" value="link">
                        <input type="hidden" class="form-admin-label" name="custom_fields[${repeater_key}][value][row-0][${custom_text_name_value}][admin_label]" value="${custom_text_label_value}">
                   </div>
               </div>
           </div>
          `;



        return form_input;
    }



    function insertImageField(el, repeater_key){
        var custom_text_label_value = $(el).find(".custom-label").val(),
            custom_text_name_value = url_slug($(el).find(".custom-input-name").val());

        var   form_input = `
           <div class="row inputRow" data-type="image" data-key="${repeater_key}" data-row="0" data-name="${custom_text_name_value}">
              <div class="col-12">
                <p>${custom_text_label_value}</p>
              </div>
              <div class="col-md-12">
                   <div class="form-group custom-form-group">
                       <label for="custom_input_image">${image_label}</label>
                       <span class="input-group-btn">
                          <a id="lfm" data-input="thumbnail_0" data-preview="holder" class="btn btn-primary choose-image">
                            <i class="fa fa-picture-o"></i> ${image_preview_label}
                          </a>
                        </span>
                      <input id="thumbnail_0" class="form-control form-image" type="text" name="custom_fields[${repeater_key}][value][row-0][${custom_text_name_value}][value]">
                      <input type="hidden" name="custom_fields[${repeater_key}][value][row-0][${custom_text_name_value}][type]" class="form-type" value="image">
                      <input type="hidden" class="form-admin-label" name="custom_fields[${repeater_key}][value][row-0][${custom_text_name_value}][admin_label]" value="${custom_text_label_value}">
                   </div>
               </div>
           </div>
          `;



        return form_input;

    }








});