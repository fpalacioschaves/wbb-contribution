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


        add_action('wp_ajax_wbb_contribution_do_login', array($this, 'wbb_contribution_do_login'));
        add_action('wp_ajax_nopriv_wbb_contribution_do_login', array($this, 'wbb_contribution_do_login'));

        add_shortcode('wbb-contribution-account', array(
            $this,
            'wbb_contribution_account_shortcode'
                )
        );


        add_action('user_register', array($this, 'wbb_contribution_user_registration'), 10, 2);
        add_action('wp_authenticate_user', array($this, 'wbb_contribution_user_pre_login'), 10, 2);

        add_action('template_redirect', array($this, 'redirect_404'));
    }

    function redirect_404() {

            
        
        global $options, $wp_query;

        if ($wp_query->is_404) {

            $url = explode("/", $_SERVER['REQUEST_URI']);

            if ($url[1] === "login_verify")
            {

                global $wpdb;

                $user_id = $wpdb->get_var("SELECT user_id FROM wp_usermeta WHERE meta_key = '_wbb_user_code' AND meta_value = '$url[2]'");

                if ($user_id)
                {

                    update_user_meta($user_id, "_wbb_user_active", "yes");
                    get_user_by("user_id", $user_id);
                    
                    //wp_redirect( home_url() );
                    wp_redirect( "/activate_user/" );
                    
                }
                else
                {
                    include("views/user_code_wrong.php");
                }
                
                
                
            }
            else if ($url[1] === "activate_user")
            {
                ?>
                <script>document.title = "<?php echo get_option("wbb_contribution_title_user_activation_message"); ?>";</script>
                <?php
                include("views/user_activation_message.php");
                
            }
            else
            {
                
                include("views/404.php");
                
            }
            

            exit();
        }
    }

    /**
     * 
     * @param type $user_id
     */
    function wbb_contribution_user_registration($user_id) {

        update_user_meta($user_id, "_wbb_user_active", "no");
        update_user_meta($user_id, "_wbb_user_code", "user_$user_id");
    }

    function wbb_contribution_user_pre_login($user, $password) {

        global $wpdb;

        if (get_user_meta($user->ID, "_wbb_user_active", true) === "yes") {

            update_user_meta($user->ID, "new_test", $user->ID);
            //Nothing to do. The user can do login.

            return $user;
        } else {

            update_user_meta($user->ID, "Failed Login", $user);
            return new WP_Error('broke', __("Error, generic message for this error.", "my_textdomain"));
        }
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
                    if ($is_valid == "true") {
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
        wp_enqueue_script($this->WBB_Contribution . "-hellojs", plugin_dir_url(__FILE__) . 'js/hellojs/hello.js', array('jquery'), $this->version, false);
        wp_enqueue_script($this->WBB_Contribution . "-hellojs-then", plugin_dir_url(__FILE__) . 'js/hellojs/hello.then.js', array('jquery'), $this->version, false);
        wp_enqueue_script($this->WBB_Contribution . "-hellojs-ids", plugin_dir_url(__FILE__) . 'js/hellojs/client_ids.js', array('jquery'), $this->version, false);
        wp_enqueue_script($this->WBB_Contribution . "-hellojs-twitter", plugin_dir_url(__FILE__) . 'js/hellojs/modules/twitter.js', array('jquery'), $this->version, false);
        wp_enqueue_script($this->WBB_Contribution . "-hellojs-facebook", plugin_dir_url(__FILE__) . 'js/hellojs/modules/facebook.js', array('jquery'), $this->version, false);
        wp_enqueue_script($this->WBB_Contribution . "-wbb-contribution-public", plugin_dir_url(__FILE__) . 'js/wbb-contribution-public.js', array('jquery'), $this->version, false);
        wp_localize_script(
                $this->WBB_Contribution . "-wbb-contribution-public"
                , 'MyAjax'
                , array(
            // URL to wp-admin/admin-ajax.php to process the request
            'ajaxurl' => admin_url('admin-ajax.php')
                )
        );
    }

    public function wbb_contribution_do_login() {


        if (isset($_POST["social"])) {

            if ($_POST["social"] === "facebook") {

                $user = $_POST["user"];
                $this->check_facebook_user($user);
                
            } else if ($_POST["social"] === "twitter") {

                $user = $_POST["user"];
                $this->check_twitter_user($user);
            } else {

                echo "<br>Desconocido, fin de línea";
            }
        } else {
            echo "<br>No social";
        }
        die();
    }

    public function check_facebook_user($user) {


        $user_id = get_user_by("email", $user["email"])->ID;

        if ($user_id) {

            $user = get_user_by('id', $user_id);

            if ($user) {

                wp_set_current_user($user_id, $user->user_login);
                wp_set_auth_cookie($user_id);
                do_action('wp_login', $user->user_login);
            }
        } else {

            //"User Not register - Register and Login";
            $this->register_and_login_new_user($user["name"], $user["email"]);
        }
    }

    public function check_twitter_user($user) {

        print_r("user <br>");

        //$email = $user["name"] . "@twitter_dummy_mail.com";

        $user_id = get_user_by("email", $email)->ID;

        if ($user_id) {

            $user = get_user_by('id', $user_id);

            if ($user) {

                wp_set_current_user($user_id, $user->user_login);
                wp_set_auth_cookie($user_id);
                do_action('wp_login', $user->user_login);
            }
        } else {

            $name = $user["name"];

            //"User Not register - Register and Login";
            $this->register_and_login_new_user($name, $email);
        }
    }

    function register_and_login_new_user($name, $email) {

        $password = wp_generate_password(12, true);
        $new_user_id = wp_create_user($name, $password, $email);

        //print_r("register: " . $name . " / $password / $email");
        //Redirect to "you need activate your account"
        //wp_set_current_user($new_user_id);
    }

}

/*
EN ESTE CONTROLADOR HAY QUE AÑADIR QUE CUANDO SE TIENE ACTIVA LA OPCIÓN DE ENVIAR E-MAIL PARA
 * CONFIRMAR A LOS USUARIOS, SE HAGA UN CHEQUEO POR CADA LOGIN/NUEVO USUARIO. 
 * 
 * get_option("activate_by_mail");
 * 
 *  */