(function ($) {
    'use strict';
    $(document).ready(function () {

$("#js-user-results-table").dragtable();

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
        
        
        
        
        $(".js-user-meta-checkbox input").change(function(){
            
            var user_field_option = $(this).attr("id");
            var user_field_value = "";
            
            if( this.checked )
            {
                user_field_value = "true";
            }
            else
            {
                user_field_value = "false";
            }
            
            var data = {
                  action:               "user_fields_option"
                , user_field_option:    user_field_option
                , user_field_value:     user_field_value
            };
            
            $.post(MyAjax.ajaxurl, data, function(response){
               
                console.log(response);
                
            });
            
            
        });


        $(document).on("click", ".js-trigger-upload-user-file", function () {
            $(".js-upload-users-csv").click();
        });

        $(document).on("change", ".js-upload-users-csv", function () {
            
            var inputFileImage = document.getElementById("js-upload-users-csv");
            var file = inputFileImage.files[0];
            
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

                    $(".js-user-results-table thead").html("")
                    $(".js-user-results-table tbody").html("")

                    $.each(response, function(i, val){
                        
                        $(".js-user-results-table tbody").append(val);
                        
                    });

                    


                }
            });
            
        });

        $(document).on("click", ".js-run-import", function(){
            
            //Get options.
            
            var options = $(".js-import-option:checked");
            var options_to_send = {};
            
            $.each(options, function(i,val){
                
                options_to_send.push( $(val).attr("id") );
                
            });
            
            //All users imported.
            
            var users_to_import = $(".js-user-results-table tbody tr");
            
            $.each(users_to_import, function(i, val){
               
                var user_td = $("td", val);
                
                console.log( $.trim( $(user_td[0]).html() ) );
                
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
