<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    WBB_Contribution
 * @subpackage WBB_Contribution/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    WBB_Contribution
 * @subpackage WBB_Contribution/includes
 * @author     Your Name <email@example.com>
 */
class WBB_Contribution_Activator {

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate() {
        WBB_Contribution_Activator::create_page_my_account();
    }
    
    
    // Create page for my account
    function create_page_my_account(){
        
        $my_page = array(
            'post_title' => 'My account',
            'post_content' => '[wbb-contribution-account]',
            'post_status' => 'publish',
            'post_type' => 'page',
          
        );

        $post_id = wp_insert_post($my_page);
    }
    
    

}
