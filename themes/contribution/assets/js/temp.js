(function($) {
    'use strict';



    $(document).on("click",".js-login-wp span" ,function() {
        
        $(this).parents(".js-login-wp").find(".js-wp-login-form").toggleClass("active");

    });

})(jQuery);