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
                      action:   "wbb_contribution_do_login"
                    , social:   "facebook"
                    , user:     json
                };

                $.post(MyAjax.ajaxurl, data, function(response) {

                    //console.log(response);
                    location.reload();

                });

            }, function(e) {
                alert("Whoops! " + e.error.message);
            });

        });

    });

    $(document).on("click", ".js-login-twitter", function() {

        hello.login("twitter", {scope: "email"}, function() {

            hello("twitter").api("me").then(function(json) {

                console.log(json);

                var data = {
                      action:   "wbb_contribution_do_login"
                    , social:   "twitter"
                    , user:     json
                };

                $.post(MyAjax.ajaxurl, data, function(response) {

                    console.log(response);
                    //location.reload();

                });


            }, function(e) {
                alert("Whoops! " + e.error.message);
            });

        });

    });



    /*
     hello("facebook").login().then(function() {
     alert("You are signed in to Facebook");
     }, function(e) {
     alert("Signin error: " + e.error.message);
     });
     */
    /*    
     hello.init({ 
     facebook : FACEBOOK_CLIENT_ID
     //windows  : WINDOWS_CLIENT_ID,
     //google   : GOOGLE_CLIENT_ID
     },{
     // redirect_uri:'http://contribution.wbbdev.com/login-ok/'
     oauth_proxy : OAUTH_PROXY_URL
     });    
     
     hello( "facebook" ).login().then( function(){
     alert("You are signed in to Facebook");
     }, function( e ){
     alert("Signin error: " + e.error.message );
     });
     
     hello.on('auth.login', function(r){
     // Get Profile
     hello(r.network).api('/me', function(p){
     document.getElementById('login').innerHTML = "<img src='"+ p.thumbnail + "' width=24/>Connected to "+ r.network+" as " + p.name;
     });
     });
     */

})(jQuery);