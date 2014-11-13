<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    WBB_Contribution
 * @subpackage WBB_Contribution/admin
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    WBB_Contribution
 * @subpackage WBB_Contribution/admin
 * @author     Your Name <email@example.com>
 */
class WBB_Contribution_Admin {

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
     * @var      string    $WBB_Contribution       The name of this plugin.
     * @var      string    $version    The version of this plugin.
     */
    public function __construct($WBB_Contribution, $version) {

        $this->WBB_Contribution = $WBB_Contribution;
        $this->version = $version;

        add_action('admin_menu', array($this, 'register_contribution_menu_page'));

        add_action( 'wp_ajax_login_option', array($this, 'login_option') );
        add_action( 'wp_ajax_nopriv_login_option', array($this, 'login_option') );

        
    }

    public function register_contribution_menu_page() {

        add_menu_page(
                'WBB Contribution'
                , 'WBB Contribution'
                , 'manage_options'
                , 'wbb-contribution/admin/partials/wbb-contribution-admin-display.php'
                , ''
                , ''
                , 96
        );
    }

    /**
     * Register the stylesheets for the Dashboard.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in WBB_Contribution_Admin_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The WBB_Contribution_Admin_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style($this->WBB_Contribution . "-jqueryui", '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css');
        wp_enqueue_style($this->WBB_Contribution, plugin_dir_url(__FILE__) . 'css/wbb-contribution-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the dashboard.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in WBB_Contribution_Admin_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The WBB_Contribution_Admin_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        //wp_enqueue_script( $this->WBB_Contribution."-jquery", '//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js' );
        wp_enqueue_script($this->WBB_Contribution . "-jquery", "//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js");
        wp_enqueue_script($this->WBB_Contribution . "-jqueryui", '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js');
        wp_enqueue_script($this->WBB_Contribution . "-admin", plugin_dir_url(__FILE__) . 'js/wbb-contribution-admin.js', array('jquery'), $this->version, false);

        wp_localize_script(
                  $this->WBB_Contribution . "-admin"
                , 'MyAjax'
                , array(
                    // URL to wp-admin/admin-ajax.php to process the request
                    'ajaxurl' => admin_url('admin-ajax.php')
                )
        );
    }

    public function login_option() {
        
        $option = $_POST["login_option"];
        $value  = $_POST["login_value"];
        
        update_option($option, $value);
        
        die();
    }

}