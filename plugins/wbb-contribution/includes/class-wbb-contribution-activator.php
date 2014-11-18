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
        WBB_Contribution_Activator::create_page_create_contribution();
        WBB_Contribution_Activator::create_page_edit_contribution();
        WBB_Contribution_Activator::create_page_list_contribution();

        
    }

// Create page for my account
    function create_page_my_account() {

        $my_page = array(
            'post_title' => 'My account',
            'post_content' => '[wbb-contribution-account]',
            'post_status' => 'publish',
            'post_type' => 'page',
        );

        $post_id = wp_insert_post($my_page);
    }

// Create page for Create Contribution
    function create_page_create_contribution() {

        $my_page = array(
            'post_title' => 'Create Contribution',
            'post_content' => '[wbb-contribution-create]',
            'post_status' => 'publish',
            'post_type' => 'page',
        );

        $post_id = wp_insert_post($my_page);
    }

// Create page for Edit Contribution
    function create_page_edit_contribution() {

        $my_page = array(
            'post_title' => 'Edit Contribution',
            'post_content' => '[wbb-contribution-edit]',
            'post_status' => 'publish',
            'post_type' => 'page',
        );

        $post_id = wp_insert_post($my_page);
    }

// Create page for List Contribution Overview
    function create_page_list_contribution() {

        $my_page = array(
            'post_title' => 'List Contribution',
            'post_content' => '[wbb-contribution-user-overview]',
            'post_status' => 'publish',
            'post_type' => 'page',
        );

        $post_id = wp_insert_post($my_page);
    }



}
