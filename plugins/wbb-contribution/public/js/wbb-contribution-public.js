(function ($) {
    'use strict';

    hello.init({
        facebook: '752931978078014'
        , twitter: "EpEphl6tmYDf84ja4cY5E7rU6"
    });

    $(document).on("click", ".js-login-facebook", function () {

        hello.login("facebook", {scope: "email"}, function () {

            hello("facebook").api("me").then(function (json) {


                var data = {
                    action: "wbb_contribution_do_login"
                    , social: "facebook"
                    , user: json
                };

                $.post(MyAjax.ajaxurl, data, function (response) {

                    //console.log(response);
                    window.location = "/activate_user/";

                });

            }, function (e) {
                alert("Whoops! " + e.error.message);
            });

        });

    });

    $(document).on("click", ".js-login-twitter", function () {

        hello.login("twitter", {scope: "email"}, function () {

            hello("twitter").api("me").then(function (json) {

                console.log(json);

                var data = {
                    action: "wbb_contribution_do_login"
                    , social: "twitter"
                    , user: json
                };

                $.post(MyAjax.ajaxurl, data, function (response) {

                    console.log(response);
                    //location.reload();

                });


            }, function (e) {
                alert("Whoops! " + e.error.message);
            });

        });

    });

    // FORMULARIO DE ACTUALIZAR PERFIL DE USUARIO
    $(document).on("click", "#js-my-account-submit", function () {

        // Primero recojo los valores usuales del usuario
        // First name, Last name y email
        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var email = $("#email").val();
        var school = $("#school").val();
        var user_id = $("#user_id").val();
        var extended_user_fields = new Array();

        // Tomamos los campos extendidos (lo que no vienen de wp_metauser
        var counter = 0;
        $(".extended_fields").find('input').each(
                function (unusedIndex, child) {
                    var child_name = $(this).attr("name");
                    var child_value = $(this).val();
                    extended_user_fields[counter] = child_name + ":" + child_value;
                    counter++;
                });

        console.log(extended_user_fields);
        var user = new FormData();
        user.append("first_name", first_name);
        user.append("last_name", last_name);
        user.append("email", email);
        user.append("school", school);
        user.append("user_id", user_id);
        user.append("extended_user_fields", extended_user_fields);


        user.append("action", 'wbb_update_profile_user');

        $.ajax({
            url: MyAjax.ajaxurl,
            type: "POST",
            contentType: false,
            data: user,
            processData: false,
            cache: false,
            success: function (response) {
                $(".update-user-message").html(response);



            }
        })


    })



    // FORMULARIO DE CREAR ITEM
    $(document).on("click", "#js-create-item-submit", function () {

        // Primero recojo los valores usuales del item
        // First name, Last name y email
        var title = $("#title").val();
        var content = $("#content").val();
        var featured_image = $("#featured_image").val();





        var extended_item_fields = new Array();


        var item = new FormData();
        item.append("title", title);
        item.append("content", content);


        item.append("action", 'wbb_create_item');

        $.ajax({
            url: MyAjax.ajaxurl,
            type: "POST",
            contentType: false,
            data: item,
            processData: false,
            cache: false,
            success: function (response) {


                var inputFileImage = document.getElementById("featured_image");
                var file = inputFileImage.files[0];
                var data_img = new FormData();
                data_img.append("featured_image", file);
                data_img.append("action", 'upload_thumbnail');
                data_img.append("post_id", response);
                console.log(response);
                $.ajax({
                    url: MyAjax.ajaxurl,
                    type: "POST",
                    contentType: false,
                    data: data_img,
                    processData: false,
                    cache: false,
                    success: function (file_url) {
                        $(".create-item-message").html("Your item has been created");
                    }
                });



            }
        })


    })



    // BORRAR ITEM
    $(document).on("click", ".js-remove-content", function () {
        var post_id = $(this).attr("data-id");
        var data_item = new FormData();
        data_item.append("post_id", post_id);
        data_item.append("action", "wbb_remove_item");

        $.ajax({
            url: MyAjax.ajaxurl,
            type: "POST",
            contentType: false,
            data: data_item,
            processData: false,
            cache: false,
            success: function () {
                location.reload();
            }
        });
    });


    // FORMULARIO DE EDITAR ITEM
    $(document).on("click", "#js-edit-item-submit", function () {

        // Primero recojo los valores usuales del item
        // First name, Last name y email
        var title = $("#title").val();
        var content = $("#content").val();
        var featured_image = $("#featured_image").val();
        var post_id = $("#post_id").val();





        var extended_item_fields = new Array();


        var item = new FormData();
        item.append("title", title);
        item.append("content", content);
        item.append("post_id", post_id);


        item.append("action", 'wbb_edit_item');

        $.ajax({
            url: MyAjax.ajaxurl,
            type: "POST",
            contentType: false,
            data: item,
            processData: false,
            cache: false,
            success: function (response) {


                var inputFileImage = document.getElementById("featured_image");
                var file = inputFileImage.files[0];
                var filename = file.name;
                if (filename != "") {
                    var data_img = new FormData();
                    data_img.append("featured_image", file);
                    data_img.append("action", 'upload_thumbnail');
                    data_img.append("post_id", post_id);
                    console.log(response);
                    $.ajax({
                        url: MyAjax.ajaxurl,
                        type: "POST",
                        contentType: false,
                        data: data_img,
                        processData: false,
                        cache: false,
                        success: function (file_url) {
                            $(".edit-item-message").html("Your item has been created");
                        }
                    });
                }


            }
        })


    })

})(jQuery);
