<?php
/**
 * Project Name: webberty-theme-framework
 * File name: menu-top.php
 * Created by www.webberty.com
 * User: Baghina Radu Adrian
 * Email: adrian@webberty.com
 * User Website: www.webberty.com
 * Date: 9/10/13
 * Time: 21:12
 */

wp_nav_menu( array(
		'menu'              => 'primary',
		'theme_location'    => 'primary_navigation',
		'depth'             => 2,
		'container'         => 'div',
		'container_class'   => 'collapse navbar-collapse',
		'container_id'      => 'bs-example-navbar-collapse-1',
		'menu_class'        => 'nav navbar-nav',
		'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
		'walker'            => new Bootstrap_Walker())
);


?>
