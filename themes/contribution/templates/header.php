<header><!---You can add your top menu template file here/--></header>
<?php echo get_template_part ( 'templates/menu', 'top' ); ?>

<<<<<<< HEAD
<script>
    /*
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '752931978078014',
      xfbml      : true,
      version    : 'v2.2'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   */
</script>


<button class="js-login-facebook">facebook</button>
<button class="js-login-twitter">Twitter</button>

<hr>

<?php

global $current_user;

print_r($current_user);

?>
=======
<button class="js-login-facebook">Login Facebook</button>
<button class="js-login-twitter">Login Twitter</button>
>>>>>>> a779f10b3ab772dd1fb6ca7c86024f3d7e847461
