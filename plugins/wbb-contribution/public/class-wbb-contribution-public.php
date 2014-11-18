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

        /*  USER LOGIN & REGISTRATION 
        ***********************************************************************/
        

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

        
        //NEW USER WITH WP FORM
        add_action('wp_ajax_wbb_contribution_wp_new_user', array($this, 'wbb_contribution_wp_new_user'));
        add_action('wp_ajax_nopriv_wbb_contribution_wp_new_user', array($this, 'wbb_contribution_wp_new_user'));
        
        //LOGIN WITH WP FORM
        add_action('wp_ajax_wbb_wbb_contribution_do_wp_login', array($this, 'wbb_contribution_do_wp_login'));
        add_action('wp_ajax_nopriv_wbb_contribution_do_wp_login', array($this, 'wbb_contribution_do_wp_login'));
        
        
        /* END :: USER LOGIN & REGISTRATION 
        ***********************************************************************/
        
        
        
        
        
        // Shortcode for User Content Creation

        add_shortcode('wbb-contribution-create', array(
            $this,
            'wbb_contribution_create_shortcode'
                )
        );

        // Shortcode for User Content Edition

        add_shortcode('wbb-contribution-edit', array(
            $this,
            'wbb_contribution_edit_shortcode'
                )
        );

        // Shortcode for User Content Overview

        add_shortcode('wbb-contribution-user-overview', array(
            $this,
            'wbb_contribution_user_overview_shortcode'
                )
        );



        add_action('wp_ajax_wbb_update_profile_user', array($this, 'wbb_update_profile_user'));

        add_action('wp_ajax_wbb_create_item', array($this, 'wbb_create_item'));

        add_action('wp_ajax_wbb_edit_item', array($this, 'wbb_edit_item'));

        add_action('wp_ajax_upload_thumbnail', array($this, 'upload_thumbnail'));

        add_action('wp_ajax_wbb_remove_item', array($this, 'wbb_remove_item'));

        add_filter('query_vars', array($this, 'add_custom_query_var'));
        
    }

    function redirect_404() {

        global $options, $wp_query;

        if ($wp_query->is_404) {

            $url = explode("/", $_SERVER['REQUEST_URI']);

            if ($url[1] === "login_verify") {

                global $wpdb;

                $user_id = $wpdb->get_var("SELECT user_id FROM wp_usermeta WHERE meta_key = '_wbb_user_code' AND meta_value = '$url[2]'");

                if ($user_id) {

                    update_user_meta($user_id, "_wbb_user_active", "yes");
                    get_user_by("user_id", $user_id);

                    //wp_redirect( home_url() );
                    wp_redirect("/activate_user/");
                } else {
                    include("views/user_code_wrong.php");
                }
            } else if ($url[1] === "activate_user") {
                ?>
                <script>document.title = "<?php echo get_option("wbb_contribution_title_user_activation_message"); ?>";</script>
                <?php
                include("views/user_activation_message.php");
            } else {

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

    /**
     * Check before do login finally.
     * 
     * 
     * 
     * @global type $wpdb
     * @param type $user
     * @param type $password
     * @return \WP_Error
     */
    function wbb_contribution_user_pre_login($user) {

        if( ( get_option("activate_by_mail") === "true" ) )
        {
            
            if (get_user_meta($user->ID, "_wbb_user_active", true) === "yes" || $user->ID == 1 ) {

                //Nothing to do. The user can do login.
                return $user;

            } else {

                update_user_meta($user->ID, "Failed Login", $user);
                return new WP_Error('broke', __("Error, generic message for this error.", "my_textdomain"));
            }
            
        }
        else
        {
            //Nothing to do. The user can do login.
            return $user;
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
            echo "<div class='extended_fields' style='border: 1px solid #000;'>";
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
            echo "</div>";
            include("views/my_account_send_button.php");
        } else {
            echo 'No tienes permiso para estar aqui. Tienes que registrarte o logarte.';
        }
    }

    public function wbb_update_profile_user() {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $user_id = $_POST['user_id'];

        // Actualizamos usuario
        $user_id = wp_update_user(array('ID' => $user_id, 'user_email' => $email));

        update_user_meta($user_id, 'first_name', $first_name);
        update_user_meta($user_id, 'last_name', $last_name);
        update_user_meta($user_id, 'last_name', $last_name);

        // Y los campos extendidos
        $extended_fields = explode(",", $_POST['extended_user_fields']);
        foreach ($extended_fields as $extended_field) {
            $chain = explode(":", $extended_field);
            $key = $chain[0];
            $value = $chain[1];
            update_user_meta($user_id, $key, $value);
        }

        if (is_wp_error($user_id)) {
            echo "There is an error";
        } else {
            echo "Your profile has been updated.";
        }

        die();
    }

    // SHORTCODE FOR CREATE CONTENT
    public function wbb_contribution_create_shortcode() {

        if (is_user_logged_in()) {


            // Include con los valores normales del usuario
            include("views/create_item.php");
            // Ahora cojo los meta fields del post


            echo "<div class='extended_fields' style='border: 1px solid #000;'>";
            include("views/create_item_extended.php");
            echo "</div>";
            // Y el boton
            include("views/create_item_send_button.php");
        } else {
            echo 'No tienes permiso para estar aqui. Tienes que registrarte o logarte.';
        }
    }

    public function wbb_create_item() {
        $current_user = wp_get_current_user();
        $user_id = $current_user->ID;
        $title = $_POST['title'];
        $content = $_POST['content'];


        $my_post = array(
            'post_type' => 'contribution',
            'post_title' => $title,
            'post_content' => $content,
            'post_status' => 'publish',
            'post_author' => $user_ID,
        );

        // Creamos item
        $post_id = wp_insert_post($my_post);



        if (is_wp_error($my_post)) {
            echo "There is an error";
        } else {
            echo $post_id;
        }

        die();
    }

    public function wbb_edit_item() {
        $current_user = wp_get_current_user();
        $user_id = $current_user->ID;
        $title = $_POST['title'];
        $content = $_POST['content'];
        $post_id = $_POST['post_id'];


        $my_post = array(
            'ID' => $post_id,
            'post_content' => $content,
            'post_title' => $title,
        );

// Update the post into the database
        wp_update_post($my_post);





        if (is_wp_error($my_post)) {
            echo "There is an error";
        } else {
            echo $post_id;
        }

        die();
    }

    /**
     * Upload Thumbnail file
     * @param $email
     * @return mixed
     */
    public function upload_thumbnail() {

        if (!function_exists('wp_handle_upload'))
            require_once( ABSPATH . 'wp-admin/includes/file.php' );

        $post_id = $_POST['post_id'];

        $uploadedfile = $_FILES['featured_image'];

        $upload_overrides = array('test_form' => false);

        $movefile = wp_handle_upload($uploadedfile, $upload_overrides);


        if ($movefile) {

            $image_url = $movefile["url"]; // Define the image URL here
            $upload_dir = wp_upload_dir(); // Set upload folder
            $image_data = file_get_contents($image_url); // Get image data
            $filename = basename($image_url); // Create image file name
            // Check folder permission and define file location
            if (wp_mkdir_p($upload_dir['path'])) {
                $file = $upload_dir['path'] . '/' . $filename;
            } else {
                $file = $upload_dir['basedir'] . '/' . $filename;
            }

            // Create the image  file on the server
            file_put_contents($file, $image_data);

            // Check image file type
            $wp_filetype = wp_check_filetype($filename, null);

            // Set attachment data
            $attachment = array(
                'post_mime_type' => $wp_filetype['type'],
                'post_title' => sanitize_file_name($filename),
                'post_content' => '',
                'post_status' => 'inherit'
            );

            // Create the attachment
            $attach_id = wp_insert_attachment($attachment, $file, $post_id);

            // Include image.php
            //require_once(ABSPATH . 'wp-admin/includes/image.php');
            // Define attachment metadata
            $attach_data = wp_generate_attachment_metadata($attach_id, $file);

            // Assign metadata to attachment
            wp_update_attachment_metadata($attach_id, $attach_data);

            // And finally assign featured image to post
            set_post_thumbnail($post_id, $attach_id);
        } else {
            echo "ERROR";
        }

        die();
    }

    // SHORTCODE FOR OVERVIEW CONTENT CREATED BY USER
    public function wbb_contribution_user_overview_shortcode() {

        if (is_user_logged_in()) {

            // Tomamos todos los contenidos creados por un usuario
            $current_user = wp_get_current_user();
            $user_id = $current_user->ID;

            $author_query = array('posts_per_page' => '-1', 'author' => $user_id, 'post_type' => "contribution");
            $author_posts = new WP_Query($author_query);

            while ($author_posts->have_posts()) : $author_posts->the_post();
                global $post;
                ?>
                <div style="width: 100%;">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    <a href="<?php echo site_url(); ?>/edit-item/?id=<?php echo get_the_ID(); ?>" data-id="<?php echo get_the_ID(); ?>">Edit</a>
                    <a href="#" class="js-remove-content" data-id="<?php echo get_the_ID(); ?>">Remove</a>
                </div>       
                <?php
            endwhile;
        } else {
            echo 'No tienes permiso para estar aqui. Tienes que registrarte o logarte.';
        }
    }

    // SHORTCODE FOR OVERVIEW CONTENT CREATED BY USER
    public function wbb_contribution_edit_shortcode() {

        if (is_user_logged_in()) {

            $post_id = $_GET['id'];

            $the_contribution = get_post($post_id);

            $the_title = $the_contribution->post_title;
            $the_content = $the_contribution->post_content;



            // Tomamos todos los contenidos creados por un usuario
            $current_user = wp_get_current_user();
            $user_id = $current_user->ID;
            include("views/edit_item.php");

            include("views/edit_item_send_button.php");
        } else {
            echo 'No tienes permiso para estar aqui. Tienes que registrarte o logarte.';
        }
    }

    // BORRAR ITEM
    public function wbb_remove_item() {
        $current_user = wp_get_current_user();
        $user_id = $current_user->ID;
        $post_id = $_POST['post_id'];


        // Borramos item
        wp_delete_post($post_id);



        if (is_wp_error($my_post)) {
            echo "There is an error";
        } else {
            echo "Your items has been removed";
        }

        die();
    }

    public function add_custom_query_var($vars) {
        $vars[] = "id";
        return $vars;
    }

    public function enqueue_styles() {

        wp_enqueue_style($this->WBB_Contribution, plugin_dir_url(__FILE__) . 'css/wbb-contribution-public.css', array(), $this->version, 'all');
        
    }
    

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        //LOGIN & REGISTER
        wp_enqueue_script($this->WBB_Contribution . "-hellojs", plugin_dir_url(__FILE__) . 'js/hellojs/hello.js', array('jquery'), $this->version, false);
        wp_enqueue_script($this->WBB_Contribution . "-hellojs-then", plugin_dir_url(__FILE__) . 'js/hellojs/hello.then.js', array('jquery'), $this->version, false);
        wp_enqueue_script($this->WBB_Contribution . "-hellojs-ids", plugin_dir_url(__FILE__) . 'js/hellojs/client_ids.js', array('jquery'), $this->version, false);
        wp_enqueue_script($this->WBB_Contribution . "-hellojs-twitter", plugin_dir_url(__FILE__) . 'js/hellojs/modules/twitter.js', array('jquery'), $this->version, false);
        wp_enqueue_script($this->WBB_Contribution . "-hellojs-facebook", plugin_dir_url(__FILE__) . 'js/hellojs/modules/facebook.js', array('jquery'), $this->version, false);
        
        wp_enqueue_script($this->WBB_Contribution . "-wbb-contribution-login-and-register", plugin_dir_url(__FILE__) . 'js/login_and_register.js', array('jquery'), $this->version, false);
        wp_localize_script(
                $this->WBB_Contribution . "-wbb-contribution-login-and-register"
                , 'MyAjax'
                , array(
            // URL to wp-admin/admin-ajax.php to process the request
            'ajaxurl' => admin_url('admin-ajax.php')
                )
        );
        
        //End login & register -------------------------------------------------
        
        
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

        if (isset($_POST["social"]))
        {

            if ($_POST["social"] === "facebook")
            {

                $user = $_POST["user"];
                $this->check_facebook_user($user);
                
            }
            else if ($_POST["social"] === "twitter")
            {

                $user = $_POST["user"];
                $this->check_twitter_user($user);
                
            }
            else
            {

                //echo " Unknown social ";
                
            }
            
        }
        else
        {
            //echo "No social";
        }
        
        die();
        
    }

    function check_facebook_user($user) {

        $user_id = get_user_by("email", $user["email"])->ID;

        if ($user_id)
        {

            $user = get_user_by('id', $user_id);
            $this->check_login_user( $user );
            
        }
        else
        {

            //"User Not register - Register and Login";
            $this->register_and_login_new_user($user["name"], $user["email"]);
            
        }
    }

    function check_twitter_user($user) {

        $user["email"] = $user["screen_name"] . "@twitterdummymail.com";

        $user_id = get_user_by("email", $user["email"])->ID;

        if ($user_id)
        {

            $user = get_user_by('id', $user_id);
            $this->check_login_user( $user );
            
        }
        else
        {

            //"User Not register - Register and Login";
            $this->register_and_login_new_user($user["name"], $user["email"]);
            
        }
    }

    /**
     * Check if in the admin there are options to filter the login. Like activated by email.
     * 
     * @param type $user
     */
    function check_login_user($user)
    {
     
        //Activate by email
        if( get_option("activate_by_mail") === "true" )
        {
            
            if( get_user_meta( $user->ID, "_wbb_user_active", true ) === "no")
            {
                
                echo "/activate_user/";
                
            }
            else if( get_user_meta( $user->ID, "_wbb_user_active", true ) === "yes")
            {
                
                wp_set_current_user($user->ID, $user->user_login);
                wp_set_auth_cookie($user->ID);
                do_action('wp_login', $user->user_login);
                
                echo home_url();
                
            }
            
            
        }
        else
        {
            
            wp_set_current_user($user->ID, $user->user_login);
            wp_set_auth_cookie($user->ID);
            do_action('wp_login', $user->user_login);
         
            echo home_url();
            
        }
        
    }
    
    function register_and_login_new_user($name, $email, $password) {

        if( $password === "" )
        {
            $password       = wp_generate_password(12, true);
        }
        
        $new_user_id    = wp_create_user($name, $password, $email);
        
        $user = get_user_by("email", $email);
        
        echo "user $name $email $password";
        
        $this->check_login_user($user);
        
    }

    public function wbb_contribution_wp_new_user(){
        
        $user = get_user_by("email", $_POST["email"]);
        
        if( $user )
        {
            $this->check_login_user($user);
        }
        else
        {
            $this->register_and_login_new_user($_POST["username"], $_POST["email"], $_POST["password"]);
        }
        
        die();
    }
    
    public function wbb_contribution_do_wp_login(){
        
        
        
    }
    
}