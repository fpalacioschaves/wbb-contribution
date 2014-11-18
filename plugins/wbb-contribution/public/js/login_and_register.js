(function($) {
    'use strict';

    hello.init({
        facebook: '752931978078014'
        , twitter: "EpEphl6tmYDf84ja4cY5E7rU6"
    });

    $(document).on("click", ".js-login-facebook", function() {

        hello.login("facebook", {scope: "email"}, function() {

            hello("facebook").api("me").then(function(json) {


                var data = {
                    action: "wbb_contribution_do_login"
                    , social: "facebook"
                    , user: json
                };

                $.post(MyAjax.ajaxurl, data, function(redirect) {

                    window.location = redirect;

                });

            }, function(e) {
                alert("Whoops! " + e.error.message);
            });

        });

    });

    $(document).on("click", ".js-login-twitter", function() {

        hello.login("twitter", {scope: "email"}, function() {

            hello("twitter").api("me").then(function(json) {

                var data = {
                    action: "wbb_contribution_do_login"
                    , social: "twitter"
                    , user: json
                };

                $.post(MyAjax.ajaxurl, data, function(redirect) {

                    window.location = redirect;

                });


            }, function(e) {
                alert("Whoops! " + e.error.message);
            });

        });

    });
    
    $(document).on("click", ".js-wp-do-login", function(){
       
        var username    = $(".js-login-form-user").val();
        //var email       = $(".js-login-new-user-form-email").val();
        var password    = $(".js-login-form-password").val();
        
        var data = {
              action:   "wbb_contribution_do_wp_login"
            , username: username
            , password: password
        };

        $.post(MyAjax.ajaxurl, data, function(redirect) {
            //console.log(redirect)
            window.location = redirect;

        });
        
    });
    
    $(document).on("click", ".js-new-user", function(){
       
        var username    = $(".js-login-new-user-form-user").val();
        var email       = $(".js-login-new-user-form-email").val();
        var password    = $(".js-login-new-user-form-password").val();
        
        var data = {
              action:   "wbb_contribution_wp_new_user"
            , username: username
            , email:    email
            , password: password
        };

        $.post(MyAjax.ajaxurl, data, function(redirect) {

            window.location = redirect;

        });
        
    });
    



})(jQuery);