(function( $ ) {
	'use strict';

    $(document).ready(function(){
        
        //Init accordion
        $( "#js-accordion-main" ).accordion();


        /*--------------------------------------------------------------------*/
        /*-- LOGIN OPTIONS --*/
        /*--------------------------------------------------------------------*/
        
        $(".js-login-checkbox input").change(function(){
            
            var login_option = $(this).attr("id");
            var login_value = "";
            
            if( this.checked )
            {
                login_value = "true";
            }
            else
            {
                login_value = "false";
            }
            
            var data = {
                  action:       "login_option"
                , login_option: login_option
                , login_value:  login_value
            };
            
            $.post(MyAjax.ajaxurl, data, function(response){
               
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



    });

})( jQuery );
