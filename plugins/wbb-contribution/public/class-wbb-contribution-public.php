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
    public function __construct($WBB_Contribution, $version) {

        $this->WBB_Contribution = $WBB_Contribution;
        $this->version = $version;

        // Shortcode for User Profile

        add_shortcode('wbb-contribution-account', array(
            $this,
            'wbb_contribution_account_shortcode'
                )
        );
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public static $exclude_default_user_fields = array(
        "admin_color",
        "comment_shortcuts",
        "dismissed_wp_pointers",
        "rich_editing",
        "session_tokens",
        "show_admin_bar_front",
        "show_welcome_panel",
        "use_ssl",
        "wp_capabilities",
        "wp_dashboard_quick_press_last_post_id",
        "wp_user_level",
        "managenav-menuscolumnshidden",
        "metaboxhidden_nav-menus",
        "nav_menu_recently_edited",
        "wp_user-settings",
        "wp_user-settings-time"
    );

    public function wbb_contribution_account_shortcode() {

        if (is_user_logged_in()) {

            $current_user = wp_get_current_user();
            $user_id = $current_user->ID;
            $user_last_name = get_user_meta($user_id, "last_name", true);
            $user_first_name = get_user_meta($user_id, "first_name", true);
            $user_email = $current_user->user_email;

            // Include con los valores normales del usuario
            include("views/my_account.php");
            // Ahora cojo los meta data del user
            $all_meta_for_user = get_user_meta($user_id);

            foreach ($all_meta_for_user as $key => $value) {

                if (!in_array($key, self::$exclude_default_user_fields)) {
                    $user_meta_key = $key;
                    $user_meta_value = $value[0];
                    // Miro si está a true en wp_options
                    global $wpdb;
                    $valid_field = $wpdb->get_results("SELECT * FROM wp_options WHERE option_name = '$user_meta_key'");
             
                    $is_valid = $valid_field[0]->option_value;
                    if($is_valid == "true"){
                    include("views/my_account_extended.php");
                    }
                }
                
            }
            include("views/my_account_send_button.php");
        } else {
            echo 'No tienes permiso para estar aqui. Tienes que registrarte o logarte.';
        }
    }

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
        wp_enqueue_style($this->WBB_Contribution, plugin_dir_url(__FILE__) . 'css/wbb-contribution-public.css', array(), $this->version, 'all');
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
        wp_enqueue_script($this->WBB_Contribution, plugin_dir_url(__FILE__) . 'js/wbb-contribution-public.js', array('jquery'), $this->version, false);
    }

}
