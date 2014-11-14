(function ($) {
    'use strict';
    $(document).ready(function () {

//Init accordion
        $("#js-accordion-main").accordion();
        /*--------------------------------------------------------------------*/
        /*-- LOGIN OPTIONS --*/
        /*--------------------------------------------------------------------*/

        $(".js-login-checkbox input").change(function () {

            var login_option = $(this).attr("id");
            var login_value = "";
            if (this.checked)
            {
                login_value = "true";
            }
            else
            {
                login_value = "false";
            }

            var data = {
                action: "login_option"
                , login_option: login_option
                , login_value: login_value
            };
            $.post(MyAjax.ajaxurl, data, function (response) {

                console.log(response);
            });
        });




        $(".js-user-meta-checkbox input").change(function () {

            var user_field_option = $(this).attr("id");
            var user_field_value = "";

            if (this.checked)
            {
                user_field_value = "true";
            }
            else
            {
                user_field_value = "false";
            }

            var data = {
                action: "user_fields_option"
                , user_field_option: user_field_option
                , user_field_value: user_field_value
            };

            $.post(MyAjax.ajaxurl, data, function (response) {

                console.log(response);

            });


        });


        $(document).on("click", ".js-trigger-upload-user-file", function () {
            $(".js-upload-users-csv").click();
        });

        $(document).on("change", ".js-upload-users-csv", function () {

            var inputFile = document.getElementById("js-upload-users-csv");
            var file = inputFile.files[0];

            var data = new FormData();
            data.append("action", "read_csv_user_file");
            data.append("file", file);

            $.ajax({
                url: MyAjax.ajaxurl,
                type: "POST",
                contentType: false,
                data: data,
                dataType: "json",
                processData: false,
                cache: false,
                success: function (response) {

                    //$(".js-user-results-table thead tr").remove()
                    //$(".js-user-results-table tbody").html("");

                    $.each(response, function (i, val) {
                        
                        //Sometimes the csv return empty lines.
                        if( val.length > 9 )
                        {
                            
                            if (i < 1)
                            {
                                val = val.replace(/td/g, "th");
                                $(".js-user-results-table thead").append(val);
                            }
                            else
                            {
                                $(".js-user-results-table tbody").append(val);
                            }
                            
                        }
                        
                    });

                    $("#js-user-results-table").dragtable();


                }
            });

        });

        $(document).on("click", ".js-run-import", function () {

            //Get options.
            if( $("#overwrite_exist_user").is(':checked') )
            {
                var option = true;
            }
            else
            {
                var option = false;
            }
            
            

            //All users imported.

            var headers = $(".js-user-results-table thead th");
            var users_to_import = $(".js-user-results-table tbody tr");

            $.each(users_to_import, function (i, val) {

                var user_td = $("td", val);

                $(val).css("background-color", "orange");

                var user_array = {
                      "overwrite": option
                    , "user_data": {
                          "password":   $.trim($(user_td[2]).html())
                        , "email":      $.trim($(user_td[1]).html())
                        , "username":   $.trim($(user_td[0]).html())

                    }
                    , "user_meta": {}

                };
                    console.log(user_array["overwrite"]);
                $.each(headers, function(index, value){
                    
                    var user_td = $("td", val);
                    
                    if( index > 2 )
                    {
                        
                        user_array["user_meta"][$.trim($(this).html())] = $.trim($(user_td[index]).html());
                        
                    }
                    
                    
                });


                var data = {
                      action: "wbb_contribution_new_user"
                    , user: user_array
                };

                $.ajax({
                    url: MyAjax.ajaxurl,
                    type: "POST",
                    data: data,
                    success: function (result_user) {
                        
                         $(val).css("background-color", result_user);

                    }
                    , error: function(err){console.log(err.message);}
                });



                /*
                 $.post(MyAjax.ajaxurl, data, function( new_user ){
                 
                 if( parseInt( new_user ) > 1 )
                 {
                 $(val).css("background-color", "green");
                 }
                 else
                 {
                 $(val).css("background-color", "red");
                 }
                 
                 //$(".user-results-table-container").scrollTop();
                 
                 });
                 */

            });

            /*
             //Send options and file.
             $.ajax({
             url: MyAjax.ajaxurl,
             type: "POST",
             contentType: false,
             data: data,
             dataType: "json",
             processData: false,
             cache: false,
             success: function (response) {
             
             
             
             }
             });
             */
        });


    });
})(jQuery);
