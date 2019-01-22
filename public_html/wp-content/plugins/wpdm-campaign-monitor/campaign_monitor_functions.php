<?php

if (!defined('WPINC')) {
    exit;
}

class WpdmEmailCampaignMonitorUtility {

    // get an array of all mailchimp subscription lists
    private $options;

    public function __construct() {
        $this->options = get_option('wpdm_email_campaign_monitor');
    }

    // -------------- Get Campaign Monitor Lists -------------- //
    public function getLists($client_id) {

	if(strlen(trim($this->options['api'])) > 0 && strlen(trim($this->options['api'])) > 0 ) {

		$lists = array();

		require_once(dirname(__FILE__) . '/campaign/csrest_clients.php');

		$wrap = new CS_REST_Clients($client_id, $this->options['api']);

		$result = $wrap->get_lists();

		if($result->was_successful()) {
			foreach($result->response as $list) {
				$lists[$list->ListID] = $list->Name;
			}
			return $lists;
		}
	}
	return array(); // return a blank array if the API key is not set
    }
    
    // -------------- Add email to Campaign Monitor subscription list -------------- //
    public function subscribeEmail($list_id,$email, $name) {
	if(strlen(trim($this->options['api'])) > 0 ) {

		require_once(dirname(__FILE__) . '/campaign/csrest_subscribers.php');

		$wrap = new CS_REST_Subscribers($list_id, $this->options['api']);

		$subscribe = $wrap->add(array(
			'EmailAddress' => $email,
			'Name' => $name,
			'Resubscribe' => true
		));

		if($subscribe->was_successful()) {
			return true;
		}
	}
	return false;
    }
    
    // -------------- Get All Clients -------------- //
    public function getClients() {
	if(strlen(trim($this->options['api'])) > 0 ) {

		require_once(dirname(__FILE__) . '/campaign/csrest_general.php');

		$wrap = new CS_REST_General($this->options['api']);

		$result = $wrap->get_clients();
                
		if($result->was_successful()) {
			foreach($result->response as $list) {
				$lists[$list->ClientID] = $list->Name;
			}
			return $lists;
		}
	}
	return false;
    }
   

}
