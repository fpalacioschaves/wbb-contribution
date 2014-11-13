<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    WBB_Contribution
 * @subpackage WBB_Contribution/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    WBB_Contribution
 * @subpackage WBB_Contribution/public
 * @author     Your Name <email@example.com>
 */
class WBB_Contribution_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $WBB_Contribution    The ID of this plugin.
	 */
	private $WBB_Contribution;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $WBB_Contribution       The name of the plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $WBB_Contribution, $version ) {

		$this->WBB_Contribution = $WBB_Contribution;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WBB_Contribution_Public_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WBB_Contribution_Public_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->WBB_Contribution, plugin_dir_url( __FILE__ ) . 'css/wbb-contribution-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WBB_Contribution_Public_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WBB_Contribution_Public_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->WBB_Contribution, plugin_dir_url( __FILE__ ) . 'js/wbb-contribution-public.js', array( 'jquery' ), $this->version, false );

	}

}
