<?php
/**
 * Project Name: webberty-theme-framework
 * File name: index.php
 * Created by www.webberty.com
 * User: Baghina Radu Adrian
 * Email: adrian@webberty.com
 * User Website: www.webberty.com
 * Date: 9/10/13
 * Time: 21:12
 * Required by WordPress.
 * Keep this file clean and only use it for requires.
 */
echo get_template_part ( 'templates/head' );
?>

<body <?php body_class (); ?>>

<!--[if lt IE 7]>
<div class="alert">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different
	browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to
	experience this site.
</div><![endif]-->

<?php echo get_template_part ( 'templates/header' ); ?>

<?php echo getPageContent (); ?>

<?php get_template_part ( 'templates/footer' ); ?>

</body>

</html>
