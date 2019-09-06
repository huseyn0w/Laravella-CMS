$(function(){

    var AllUsersCheckbox    = $("#selectAll"),
        users_checkbox      = $(".users-checkbox-input"),
        delete_user         = $(".delete_user"),
        delete_page         = $(".delete_page"),
        delete_post         = $(".delete_post"),
        delete_category     = $(".delete_category"),
        date_time_input     = $("#date_time_picker"),
        editor              = $(".my-editor"),
        link_label          = $("#link_label"),
        link_url            = $("#link_url"),
        add_menu_item       = $(".add_menu_item"),
        delete_menu         = $(".delete_menu"),
        menu_list           = $(".menu-list"),
        sortable            = $(".sortable"),
        pages_list          = $("#pages_list"),
        posts_list          = $("#posts_list"),
        categories_list     = $("#categories_list"),
        cpanel_title        = $("#cpanel_title"),
        cpanel_slug         = $("#cpanel_slug"),
        add_menu_form       = $("#add_menu_form"),
        menuContent         = $("#menuContent"),
        create_menu         = $(".create_menu"),
        delete_role         = $(".delete_role");


    if(date_time_input.length){
        date_time_input.datepicker({
            'timepicker':true,
            'language': 'en',
            'dateFormat':'yyyy-mm-dd',
            'timeFormat':'hh:ii:00'
        });
    }



    AllUsersCheckbox.on("click", function () {
        AllUsersCheckbox.toggleClass('all-checked');
        users_checkbox.each(function(index,el){

           if(AllUsersCheckbox.hasClass('all-checked')){
               console.log('we are here');
               $(el).attr('checked', 'checked');
           }
           else {
               console.log('we are here2');
               $(el).removeAttr('checked');
           }
        });
    });


    delete_user.on('click', function () {
       var deleted_user_id = $(this).prev('.deleted_user_id').val();
       var that = $(this);

       var delete_confirmation = confirm('Are you sure? User will be deleted');
        if(delete_confirmation){
            $.ajax({
                url: "/cpanel/users/" + deleted_user_id + "/delete/",
                type: 'DELETE',
                data: {
                    "id": deleted_user_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data)
                {
                 if(data === "OK")
                 {
                     var message = "User has been successfully deleted";
                     that.closest('tr').fadeOut(1000, function () {
                         that.remove();
                         showNotification('top','right', message, 'success');
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



    delete_role.on('click', function () {
        var deleted_role_id = $(this).prev('.deleted_role_id').val();
        var that = $(this);

        var delete_confirmation = confirm('Are you sure? Role will be deleted');
        if(delete_confirmation){
            $.ajax({
                url: "/cpanel/roles/" + deleted_role_id + "/delete/",
                type: 'DELETE',
                data: {
                    "id": deleted_role_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data)
                {
                    if(data === "OK")
                    {
                        var message = "Role has been successfully deleted";
                        that.closest('tr').fadeOut(1000, function () {
                            that.remove();
                            showNotification('top','right', message, 'success');
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

    delete_menu.on('click', function () {
        var deleted_menu_id = $(this).prev('.deleted_menu_id').val();
        var that = $(this);

        var delete_confirmation = confirm('Are you sure? Role will be deleted');
        if(delete_confirmation){
            $.ajax({
                url: "/cpanel/menus/" + deleted_menu_id + "/delete/",
                type: 'DELETE',
                data: {
                    "id": deleted_menu_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data)
                {
                    if(data === "OK")
                    {
                        var message = "Menu has been successfully deleted";
                        that.closest('tr').fadeOut(1000, function () {
                            that.remove();
                            showNotification('top','right', message, 'success');
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
                            that.remove();
                            showNotification('top','right', message, 'success');
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

    delete_post.on('click', function () {
        var deleted_post_id = $(this).prev('.deleted_post_id').val();
        var that = $(this);

        var delete_confirmation = confirm('Are you sure? Post will be deleted');
        if(delete_confirmation){
            $.ajax({
                url: "/cpanel/posts/" + deleted_post_id + "/delete/",
                type: 'DELETE',
                data: {
                    "id": deleted_post_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data)
                {
                    console.log(data);
                    if(data === "OK")
                    {
                        var message = "Post has been successfully deleted";
                        that.closest('tr').fadeOut(1000, function () {
                            that.remove();
                            showNotification('top','right', message, 'success');
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

    delete_category.on('click', function () {
        var deleted_category_id = $(this).prev('.deleted_category_id').val();
        var that = $(this);

        var delete_confirmation = confirm('Are you sure? Category will be deleted');
        if(delete_confirmation){
            $.ajax({
                url: "/cpanel/categories/" + deleted_category_id + "/delete/",
                type: 'DELETE',
                data: {
                    "id": deleted_category_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data)
                {
                    if(data === "OK")
                    {
                        var message = "Category has been successfully deleted";
                        that.closest('tr').fadeOut(1000, function () {
                            that.remove();
                            showNotification('top','right', message, 'success');
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


    function showNotification(from, align, message, messagetype){
        color = Math.floor((Math.random() * 4) + 1);

        if(messagetype === 'success'){
            var icon = 'nc-icon nc-check-2';
        }
        else{
            var icon = 'nc-icon nc-simple-remove';
        }

        $.notify({
            icon: icon,
            message: message

        },{
            type: type[color],
            timer: 4000,
            placement: {
                from: from,
                align: align
            }
        });
    }





    if(editor.length > 0){
        var editor_config = {
            path_absolute : "/",
            height : "300",
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
    }

    function url_slug(s, opt)
    {
        s = String(s);
        opt = Object(opt);

        var defaults = {
            'delimiter': '-',
            'limit': undefined,
            'lowercase': true,
            'replacements': {},
            'transliterate': true,
        };

        // Merge options
        for (var k in defaults) {
            if (!opt.hasOwnProperty(k)) {
                opt[k] = defaults[k];
            }
        }

        var char_map = {
            // Latin
            'À': 'A', 'Á': 'A', 'Â': 'A', 'Ã': 'A', 'Ä': 'A', 'Å': 'A', 'Æ': 'AE', 'Ç': 'C',
            'È': 'E', 'É': 'E', 'Ê': 'E', 'Ë': 'E', 'Ì': 'I', 'Í': 'I', 'Î': 'I', 'Ï': 'I',
            'Ð': 'D', 'Ñ': 'N', 'Ò': 'O', 'Ó': 'O', 'Ô': 'O', 'Õ': 'O', 'Ö': 'O', 'Ő': 'O',
            'Ø': 'O', 'Ù': 'U', 'Ú': 'U', 'Û': 'U', 'Ü': 'U', 'Ű': 'U', 'Ý': 'Y', 'Þ': 'TH',
            'ß': 'ss',
            'à': 'a', 'á': 'a', 'â': 'a', 'ã': 'a', 'ä': 'a', 'å': 'a', 'æ': 'ae', 'ç': 'c',
            'è': 'e', 'é': 'e', 'ê': 'e', 'ë': 'e', 'ì': 'i', 'í': 'i', 'î': 'i', 'ï': 'i',
            'ð': 'd', 'ñ': 'n', 'ò': 'o', 'ó': 'o', 'ô': 'o', 'õ': 'o', 'ö': 'o', 'ő': 'o',
            'ø': 'o', 'ù': 'u', 'ú': 'u', 'û': 'u', 'ü': 'u', 'ű': 'u', 'ý': 'y', 'þ': 'th',
            'ÿ': 'y',

            // Latin symbols
            '©': '(c)',

            // Greek
            'Α': 'A', 'Β': 'B', 'Γ': 'G', 'Δ': 'D', 'Ε': 'E', 'Ζ': 'Z', 'Η': 'H', 'Θ': '8',
            'Ι': 'I', 'Κ': 'K', 'Λ': 'L', 'Μ': 'M', 'Ν': 'N', 'Ξ': '3', 'Ο': 'O', 'Π': 'P',
            'Ρ': 'R', 'Σ': 'S', 'Τ': 'T', 'Υ': 'Y', 'Φ': 'F', 'Χ': 'X', 'Ψ': 'PS', 'Ω': 'W',
            'Ά': 'A', 'Έ': 'E', 'Ί': 'I', 'Ό': 'O', 'Ύ': 'Y', 'Ή': 'H', 'Ώ': 'W', 'Ϊ': 'I',
            'Ϋ': 'Y',
            'α': 'a', 'β': 'b', 'γ': 'g', 'δ': 'd', 'ε': 'e', 'ζ': 'z', 'η': 'h', 'θ': '8',
            'ι': 'i', 'κ': 'k', 'λ': 'l', 'μ': 'm', 'ν': 'n', 'ξ': '3', 'ο': 'o', 'π': 'p',
            'ρ': 'r', 'σ': 's', 'τ': 't', 'υ': 'y', 'φ': 'f', 'χ': 'x', 'ψ': 'ps', 'ω': 'w',
            'ά': 'a', 'έ': 'e', 'ί': 'i', 'ό': 'o', 'ύ': 'y', 'ή': 'h', 'ώ': 'w', 'ς': 's',
            'ϊ': 'i', 'ΰ': 'y', 'ϋ': 'y', 'ΐ': 'i',

            // Turkish
            'Ş': 'S', 'İ': 'I', 'Ç': 'C', 'Ü': 'U', 'Ö': 'O', 'Ğ': 'G',
            'ş': 's', 'ı': 'i', 'ç': 'c', 'ü': 'u', 'ö': 'o', 'ğ': 'g',

            // Russian
            'А': 'A', 'Б': 'B', 'В': 'V', 'Г': 'G', 'Д': 'D', 'Е': 'E', 'Ё': 'Yo', 'Ж': 'Zh',
            'З': 'Z', 'И': 'I', 'Й': 'J', 'К': 'K', 'Л': 'L', 'М': 'M', 'Н': 'N', 'О': 'O',
            'П': 'P', 'Р': 'R', 'С': 'S', 'Т': 'T', 'У': 'U', 'Ф': 'F', 'Х': 'H', 'Ц': 'C',
            'Ч': 'Ch', 'Ш': 'Sh', 'Щ': 'Sh', 'Ъ': '', 'Ы': 'Y', 'Ь': '', 'Э': 'E', 'Ю': 'Yu',
            'Я': 'Ya',
            'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'yo', 'ж': 'zh',
            'з': 'z', 'и': 'i', 'й': 'y', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o',
            'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h', 'ц': 'ts',
            'ч': 'ch', 'ш': 'sh', 'щ': 'sh', 'ъ': '', 'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu',
            'я': 'ya',

            // Ukrainian
            'Є': 'Ye', 'І': 'I', 'Ї': 'Yi', 'Ґ': 'G',
            'є': 'ye', 'і': 'i', 'ї': 'yi', 'ґ': 'g',

            // Czech
            'Č': 'C', 'Ď': 'D', 'Ě': 'E', 'Ň': 'N', 'Ř': 'R', 'Š': 'S', 'Ť': 'T', 'Ů': 'U',
            'Ž': 'Z',
            'č': 'c', 'ď': 'd', 'ě': 'e', 'ň': 'n', 'ř': 'r', 'š': 's', 'ť': 't', 'ů': 'u',
            'ž': 'z',

            // Polish
            'Ą': 'A', 'Ć': 'C', 'Ę': 'e', 'Ł': 'L', 'Ń': 'N', 'Ó': 'o', 'Ś': 'S', 'Ź': 'Z',
            'Ż': 'Z',
            'ą': 'a', 'ć': 'c', 'ę': 'e', 'ł': 'l', 'ń': 'n', 'ó': 'o', 'ś': 's', 'ź': 'z',
            'ż': 'z',

            // Latvian
            'Ā': 'A', 'Č': 'C', 'Ē': 'E', 'Ģ': 'G', 'Ī': 'i', 'Ķ': 'k', 'Ļ': 'L', 'Ņ': 'N',
            'Š': 'S', 'Ū': 'u', 'Ž': 'Z',
            'ā': 'a', 'č': 'c', 'ē': 'e', 'ģ': 'g', 'ī': 'i', 'ķ': 'k', 'ļ': 'l', 'ņ': 'n',
            'š': 's', 'ū': 'u', 'ž': 'z',
        };

        // Make custom replacements
        for (var k in opt.replacements) {
            s = s.replace(RegExp(k, 'g'), opt.replacements[k]);
        }

        // Transliterate characters to ASCII
        if (opt.transliterate) {
            for (var k in char_map) {
                s = s.replace(RegExp(k, 'g'), char_map[k]);
            }
        }

        // Replace non-alphanumeric characters with our delimiter
        var alnum = RegExp('[^a-z0-9]+', 'ig');
        s = s.replace(alnum, opt.delimiter);

        // Remove duplicate delimiters
        s = s.replace(RegExp('[' + opt.delimiter + ']{2,}', 'g'), opt.delimiter);

        // Truncate slug to max. characters
        s = s.substring(0, opt.limit);

        // Remove delimiter from ends
        s = s.replace(RegExp('(^' + opt.delimiter + '|' + opt.delimiter + '$)', 'g'), '');

        return opt.lowercase ? s.toLowerCase() : s;
    }

    cpanel_title.on("blur keyup", function () {
        var new_title = $(this).val();
        var translitted_slug = url_slug(new_title);
        cpanel_slug.val(translitted_slug);
    });

    if(sortable.length > 0)
    {
        sortable.nestedSortable({
            forcePlaceholderSize: true,
            items: 'li',
            handle: 'a',
            placeholder: 'menu-highlight',
            listType: 'ul',
            maxLevels: 5,
            opacity: .6,
        });
    }



    add_menu_item.on("click", function () {
        //var test = [];
        //test.push(pages_list.find('option:selected').text());
        getPagesFromSelects(pages_list);
        getPagesFromSelects(posts_list);
        getPagesFromSelects(categories_list);

        if(link_label.val() !== "" && link_url.val() !== ""){
            var li = '<li data-type="custom_link" data-title="'+ link_label.val() + '" data-link="'+ link_url.val() +'"><a href="javascript:void(0)"><span>'+ link_label.val() + '</span><button class="remove_menu_item" type="button">X</button></a></li>';
            console.log('hehey');
            menu_list.append(li);
            link_label.val("");
            link_url.val("");
        }
    });


    $(document).on("click", ".remove_menu_item", function(){
        $(this).closest("li").fadeOut(500, function(){
          $(this).remove();
        })
    });

    function FetchChild(){
        var data =[];
        $('.sortable > li').each(function(){
            data.push(buildJSON($(this)));
        });

        return data;
    }
    function buildJSON($li) {
        var subObj = { "title": $li.data('title'), 'slug':$li.data('link'), 'type':$li.data('type') };
        $li.children('ul').children().each(function() {
            if (!subObj.children) {
                subObj.children = [];
            }
            subObj.children.push(buildJSON($(this)));
        });
        return subObj;
    }


    function getPagesFromSelects(select)
    {
        var dataType = select.data('type');
        select.find('option:selected').each(function (ind,el) {
            var link = $(el).val();
            if(link == "") link = "/";
            var label = $(el).text();
            var li = '<li data-type="'+dataType+'" data-title="'+ label + '" data-link="'+ link +'"><a href="javascript:void(0)"><span>'+ label + '</span><button class="remove_menu_item" type="button">X</button></a></li>';

            menu_list.append(li);
        })
        select.val([]);
    }

    create_menu.on("click", function (e) {
        e.preventDefault();
        var obj = FetchChild();
        var json = JSON.stringify(obj, null);
        menuContent.val(json);
        console.log(json);
        add_menu_form.submit();
    })





});