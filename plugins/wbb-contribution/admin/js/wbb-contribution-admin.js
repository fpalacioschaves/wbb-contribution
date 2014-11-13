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



    });

})( jQuery );
