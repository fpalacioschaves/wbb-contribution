<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    WBB_Contribution
 * @subpackage WBB_Contribution/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    WBB_Contribution
 * @subpackage WBB_Contribution/includes
 * @author     Your Name <email@example.com>
 */
class WBB_Contribution_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
            WBB_Contribution_Deactivator::delete_page_my_account();
            WBB_Contribution_Deactivator::delete_page_create_contribution();
            WBB_Contribution_Deactivator::delete_page_edit_contribution();
            WBB_Contribution_Deactivator::delete_page_list_contribution();
            
	}
        
        
        // Delete My Account page
        public function delete_page_my_account(){
             $page = get_page_by_title( 'My account' );
             $page_id = $page->ID;
             wp_delete_post($page_id);
        }
        
        // Delete Create Contribution page
        public function delete_page_create_contribution(){
             $page = get_page_by_title( 'Create Contribution' );
             $page_id = $page->ID;
             wp_delete_post($page_id);
        }
        
        
        // Delete Edit Contribution page
        public function delete_page_edit_contribution(){
             $page = get_page_by_title( 'Edit Contribution' );
             $page_id = $page->ID;
             wp_delete_post($page_id);
        }
        
        
        // Delete List Contribution Overview
        public function delete_page_list_contribution(){
             $page = get_page_by_title( 'List Contribution' );
             $page_id = $page->ID;
             wp_delete_post($page_id);
        }

}
