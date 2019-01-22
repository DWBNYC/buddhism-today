<?php
namespace WPDM;

class UserProfile
{

    public $dashboard_menu;
    public $dashboard_menu_actions;

    function __construct(){
        add_action("wp", array($this, 'ProfileMenuInit'));
        add_shortcode("wpdm_user_profile", array($this, 'Profile'));
    }

    function ProfileMenuInit(){
        $this->dashboard_menu[''] = array('name'=> __('Profile','wpdmpro'), 'callback' => array($this, 'Profile'));
        $this->dashboard_menu['download-history'] = array('name'=> __('Download History','wpdmpro'), 'callback' => array($this, 'DownloadHistory'));
        $this->dashboard_menu['edit-profile'] = array('name'=> __('Edit Profile','wpdmpro'), 'callback' => array($this, 'EditProfile'));
        $this->dashboard_menu['logout'] = array('name'=> __('Logout','wpdmpro'), 'callback' => array($this, 'Logout'));
        $this->dashboard_menu = apply_filters("wpdm_user_dashboard_menu", $this->dashboard_menu);
        $this->dashboard_menu_actions = apply_filters("wpdm_dashboard_menu_actions", $this->dashboard_menu_actions);
    }

    function Profile($params = array()){
        global $wp_query;


        if(!isset($params) || !is_array($params)) $params = array();

        ob_start();
        global $current_user;
        $username = get_query_var('profile');
        if(is_author())
            $username = get_query_var('author_name');
        if($username)
            $user = get_user_by('login', $username);
        else
            $user = $current_user;

        $cols = isset($params['cols'])?$params['cols']:3;
        $items_per_page = isset($params['items_per_page'])?$params['items_per_page']:$cols*3;
        $cols = 12/$cols;
        $template = isset($params['template'])?$params['template']:'link-template-panel.php';

        include_once wpdm_tpl_path('user-profile/profile.php');
        return ob_get_clean();
    }



    function DownloadHistory(){
        global $wpdb, $current_user;
        ob_start();
        include_once wpdm_tpl_path('user-dashboard/download-history.php');
        return ob_get_clean();
    }

    function EditProfile(){
        global $wpdb, $current_user;
        ob_start();
        include_once wpdm_tpl_path('user-dashboard/edit-profile.php');
        return ob_get_clean();
    }

    function Logout(){
        wp_logout();
    }

}

