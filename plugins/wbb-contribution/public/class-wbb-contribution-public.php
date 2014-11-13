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

        print_r("register: ". $name . " / $password / $email");
        
        wp_set_current_user($new_user_id);
    }

}
