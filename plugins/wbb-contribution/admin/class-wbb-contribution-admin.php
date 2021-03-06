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

        add_action('wp_ajax_login_option', array($this, 'login_option'));


        //LOAD FILE TO IMPORT.
        add_action('wp_ajax_read_csv_user_file', array($this, 'read_csv_user_file'));

        //NEW USER  (FIRST CHECK IF EXIST.)
        add_action('wp_ajax_wbb_contribution_new_user', array($this, 'wbb_contribution_new_user'));

        //paco functions
        add_action('wp_ajax_user_fields_option', array($this, 'user_fields_option'));

        //Save the email confirmation text.
        add_action('wp_ajax_save_confirmation_email_content', array($this, 'save_confirmation_email_content'));

        // Add columns in manage user
        add_filter('manage_users_columns', array($this, 'add_user_id_column'));
        add_action('manage_users_custom_column', array($this, 'show_user_id_column_content'), 10, 3);
    }

    public function register_contribution_menu_page() {

//        add_menu_page(
//                'WBB Contribution'
//                , 'WBB Contribution'
//                , 'manage_options'
//                , 'wbb-contribution/admin/partials/wbb-contribution-admin-display.php'
//                , ''
//                , ''
//                , 96
//        );
        add_menu_page(
                "WBB Contribution", "WBB Contribution", 'manage_options', "wbb-contribution", array(
            $this,
            'wbb_plugins_view'
                )
        );
        add_submenu_page(
                "wbb-contribution", "User Login & Register", "User Login & Register", 'manage_options', 'wbb-contribution/admin/partials/login_tab.php'
        );

        add_submenu_page(
                "wbb-contribution", "Import & Export", "Import & Export", 'manage_options', 'wbb-contribution/admin/partials/imp_exp_tab.php'
        );

        add_submenu_page(
                "wbb-contribution", "User Panel", "User Panel", 'manage_options', 'wbb-contribution/admin/partials/user_panel_tab.php'
        );

        add_submenu_page(
                "wbb-contribution", "Content module", "Content module", 'manage_options', 'wbb-contribution/admin/partials/content_tab.php'
        );
    }

    public function wbb_plugins_view() {

        require_once plugin_dir_path ( dirname ( __FILE__ ) ) . 'admin/partials/initial_tab.php';
        //include("/partials/initial_tab.php");
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
        //wp_enqueue_style($this->WBB_Contribution, plugin_dir_url(__FILE__) . 'css/editor/bootstrap.css', array(), $this->version, 'all');
        wp_enqueue_style($this->WBB_Contribution . "-jqueryui", '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css');
        wp_enqueue_style($this->WBB_Contribution . "jquerysortables", plugin_dir_url(__FILE__) . 'css/dragtable.css', array(), $this->version, 'all');
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

        wp_enqueue_script($this->WBB_Contribution . "-jquerysortables", plugin_dir_url(__FILE__) . 'js/jquery.dragtable.js', array('jquery'), $this->version, false);

        wp_enqueue_script($this->WBB_Contribution . "-editor-bootstrap-dropdown", plugin_dir_url(__FILE__) . 'js/editor/bootstrap-dropdown.js');
        wp_enqueue_script($this->WBB_Contribution . "-editor-shortcut", plugin_dir_url(__FILE__) . 'js/editor/shortcut.js');
        wp_enqueue_script($this->WBB_Contribution . "-editor-farbtastic", plugin_dir_url(__FILE__) . 'js/editor/farbtastic/farbtastic.js');
        wp_enqueue_script($this->WBB_Contribution . "-editor-freshereditor", plugin_dir_url(__FILE__) . 'js/editor/freshereditor.js');

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

    /**
     * Update the options
     */
    public function login_option() {

        $option = $_POST["login_option"];
        $value = $_POST["login_value"];

        update_option($option, $value);

        die();
    }

    public function read_csv_user_file() {


        $uploaded_file = $_FILES["file"];

        $file_handle = fopen($uploaded_file["tmp_name"], "r");

        $result = array();

        while (!feof($file_handle)) {

            $line_of_text = fgetcsv($file_handle, 1024);

            $line_len = count($line_of_text);

            if ($line_len > 1) {

                $new_line = "<tr>";

                for ($l = 0; $l < $line_len; $l++) {
                    $new_line .= "<td>$line_of_text[$l]</td>";
                }

                $new_line .= "</tr>";

                array_push($result, $new_line);
            }
        }

        fclose($file_handle);

        echo json_encode($result);


        die();
    }

    public function user_fields_option() {

        $option = $_POST["user_field_option"];
        $value = $_POST["user_field_value"];

        update_option($option, $value);

        die();
    }

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

    public static function read_user_fields() {

        global $wpdb;
        $user_fields = $wpdb->get_results("SELECT DISTINCT meta_key FROM wp_usermeta");
        //print_r(self::$exclude_default_user_fields) ;
        echo "<table>";
        foreach ($user_fields as $user_field) {
            // Chequeamos si ese campo está en los campos que excluimos por defecto

            $meta_key = $user_field->meta_key;
            if (!in_array($meta_key, self::$exclude_default_user_fields)) {
                $get_option = (get_option($meta_key) === "true" ) ? 'checked' : '';
                include("views/user_meta_fields.php");
            }
        }
        echo "</table>";
    }

    function wbb_contribution_new_user() {

        $username = $_POST["user"]["user_data"]["username"];
        $email = $_POST["user"]["user_data"]["email"];
        $password = $_POST["user"]["user_data"]["password"];

        if ($password === "") {
            $password = wp_generate_password(12, true);
        }

        $user_id = get_user_by('email', $email);

        if ($user_id) {

            echo "lightblue";
            $userID = $user_id->ID;
        } else {
            $user_id = wp_create_user($username, $password, $email);
            echo "lightgreen";
            $new_user_flag = true;
            $userID = $user_id;
        }

        if ($_POST["user"]["overwrite"] || $new_user_flag) {
            //user meta loop
            foreach ($_POST["user"]["user_meta"] as $meta_key => $meta_value) {

                update_user_meta($userID, $meta_key, $meta_value);
            }
        }


        die();
    }

    function save_confirmation_email_content() {

        update_option("confirmation_mail_text", $_POST["email_text"]);
        echo $_POST["email_text"];
        die();
    }

    // ADD COLUMN USER ADMIN

    public function add_user_id_column($columns) {
        $columns['enabled'] = 'User status';

        return $columns;
    }

    public function show_user_id_column_content($value, $column_name, $user_id) {
        $user = get_userdata($user_id);
        if ('enabled' == $column_name) {
            $status = get_user_meta($user_id, "_wbb_user_active", true);
            $output .= $status;
        }
        return $output;
    }

}
