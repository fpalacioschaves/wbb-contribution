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

wp_nav_menu ( array(
	'menu_class' => 'nav navbar-nav' ,
	'walker'     => new Bootstrap_Walker()
) );
?>
