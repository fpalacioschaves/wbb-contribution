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
        
        //RUN THE IMPORT
        add_action('wp_ajax_run_the_import', array($this, 'run_the_import'));

        //paco functions
        add_action('wp_ajax_user_fields_option', array($this, 'user_fields_option'));
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
            
            $new_line = "<tr>";
            
            for($l = 0 ; $l < $line_len; $l++)
            {
                $new_line .= "<td> $line_of_text[$l] </td>";
            }
            
            $new_line .= "</tr>";
            
            array_push( $result, $new_line );
            
        }

        fclose($file_handle);

        echo json_encode( $result );


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
            "wp_user_level"
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

    public function run_the_import()
    {
        /*
        $uploaded_file = $_FILES["file"];

        $file_handle = fopen($uploaded_file["tmp_name"], "r");

        $result = array();
        
        while (!feof($file_handle)) {

            $line_of_text = fgetcsv($file_handle, 1024);

            $line_len = count($line_of_text);
            
            $new_line = "<tr>";
            
            for($l = 0 ; $l < $line_len; $l++)
            {
                $new_line .= "<td> $line_of_text[$l] </td>";
            }
            
            $new_line .= "</tr>";
            
            array_push( $result, $new_line );
            
        }

        fclose($file_handle);

        echo json_encode( $result );
         */
        
        print_r( $_POST["options"] );

        die();
        
    }
    
}
