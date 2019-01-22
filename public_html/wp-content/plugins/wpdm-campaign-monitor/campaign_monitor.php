<?php
/*
Plugin Name: WPDM - Campaign Monitor
Plugin URL: http://www.wpdownloadmanager.com/download/campaign-monitor-subscription/
Description: Campaign Monitor Subscription Addon for Download Manager Plugin
Version: 1.2.0
Author: Shaon
Author URI: http://www.wpdownloadmanager.com/
*/

if ( ! defined( 'WPINC' ) ) {
    die;
}

class WpdmEmailCampaignMonitor{
    private static $instance;
    private $dir, $url,$api;
    
    public static function getInstance() {
        if(self::$instance === null) {
            self::$instance = new self;
            self::$instance->actions();
            self::$instance->dir = dirname(__FILE__);
            self::$instance->url = WP_PLUGIN_URL . '/' . basename(self::$instance->dir);
            if(!class_exists('WpdmEmailCampaignMonitorUtility')){
                require_once 'campaign_monitor_functions.php';
            }
            self::$instance->api = new WpdmEmailCampaignMonitorUtility();
        }
        return self::$instance;
    }
    
    private function actions() {
        
        register_activation_hook(__FILE__, array($this,'activate'));
        register_deactivation_hook(__FILE__, array($this,'deactivate'));
        add_filter('add_wpdm_settings_tab', array($this, 'settingsTab'));
        if(!is_admin()){
            
        }
        
        if ( defined('DOING_AJAX') ) {
            add_action('wp_ajax_wpdm_email_cm_client',array($this,'changeClient'));
            add_action('wp_ajax_wpdm_email_cm_list',array($this,'changeList'));
        }
        
        add_action('wpdm_before_email_download_link',array($this,'subscribeHook'),10,2);
    }

    function settingsTab($tabs){
        $tabs['campaign-monitor'] = wpdm_create_settings_tab('campaign-monitor', 'Campaign Monitor', array($this, 'settings'), 'fa fa-envelope-o');
        return $tabs;
    }
    
    public function activate(){
        if(false == get_option('wpdm_email_campaign_monitor')){
            $option = array('api'=>'', 'client_id' => '', 'list_id' => '');
            add_option('wpdm_email_campaign_monitor',$option);
        }
    }
    
    public function deactivate(){
        
    }
    
    
    public static function getDir(){
        return self::$instance->dir;
    }
    
    public static function getUrl(){
        return self::$instance->url;
    }
    
    
    public function settings(){
        
        if(isset($_POST['campaign_monitor_api_key'])){
            $options['api'] = stripslashes($_POST['campaign_monitor_api_key']);
            $options['list_id'] = stripslashes($_POST['campaign_monitor_list_id']);
            $options['client_id'] = stripslashes($_POST['campaign_monitor_client_id']);
            update_option('wpdm_email_campaign_monitor',$options);
            die('Settings Saved Successfully.');
        }
        
        $options = get_option('wpdm_email_campaign_monitor');
        $api_key = $options['api'];
        $client_id = $options['client_id'];
        $list_id = $options['list_id'];
        $clients = $this->api->getClients();
        $list = $this->api->getLists($client_id);
        //print_r($list);
        //print_r($clients);
        
?>
        <div class="panel panel-default">
            <div class="panel-heading">Campaign Monitor</div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="campaign_monitor_api_key">Campaign Monitor Api Key</label>
                    <input class="form-control" type="text" name="campaign_monitor_api_key" id="campaign_monitor_api_key" value="<?php echo $api_key; ?>" placeholder="Enter Campaign Monitor API Key">
                    <em style="color: #888;">Where can I find my <a href="https://help.campaignmonitor.com/topic.aspx?t=206" target="_blank">API key</a>?</em>
                </div>
                <div class="form-group">
                    <label for="campaign_monitor_client_id">Campaign Monitor Client ID</label>
                    <select name="campaign_monitor_client_id" id="campaign_monitor_client_id" class="form-control">
                        <option>Select a Client</option>
                        <?php 
                        if($clients):
                            foreach ($clients as $key => $value):
                                echo "<option value='$key' ". selected($client_id,$key,false) .">$value</option>";
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="campaign_monitor_list_id">Campaign Monitor List</label>
                    <select name="campaign_monitor_list_id" id="campaign_monitor_list_id" class="form-control">
                        <option>Select a list</option>
                        <?php 
                        if($list):
                            foreach ($list as $key => $value):
                                echo "<option value='$key' ". selected($list_id,$key,false) .">$value</option>";
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
            </div>
        </div>

<script type="text/javascript">
    jQuery(function($){
        $('#campaign_monitor_api_key').on('change','body',function(){
            alert('worked');
            var key = $(this).val();
            var url = '<?php echo admin_url( 'admin-ajax.php' );?>';
            $('#campaign_monitor_client_id').attr('disabled','disabled');
            $('#campaign_monitor_list_id').empty().append('<option value="">Select a list</option>');
            jQuery.ajax({
                type : "post",
                dataType : "json",
                url : url,
                data : {action: "wpdm_email_cm_client", key : key},
                success: function(response) {
                   if(response.type == "success") {
                        $('#campaign_monitor_client_id').empty().append('<option value="">Select a client</option>');
                        if(response.options){
                            $.each(response.options, function (index, value) {
                              $('#campaign_monitor_client_id').append($('<option></option>').attr("value", index).text(value));
                            });
                        }
                        
                        if(response.error){
                            
                        }

                        $('#campaign_monitor_client_id').removeAttr('disabled');
                   }
                   else {
                      alert("Somthing Wrong");
                   }
                }
             });   
        });
        
        
        $('#campaign_monitor_client_id').on('change','body',function(){
            alert('worked 2');
            var client_id = $(this).val();
            var url = '<?php echo admin_url( 'admin-ajax.php' );?>';
            $('#campaign_monitor_list_id').attr('disabled','disabled');
            jQuery.ajax({
                type : "post",
                dataType : "json",
                url : url,
                data : {action: "wpdm_email_cm_list", client_id : client_id},
                success: function(response) {
                   if(response.type == "success") {
                        $('#campaign_monitor_list_id').empty().append('<option value="">Select a client</option>');
                        
                        if(response.options){
                            $.each(response.options, function (index, value) {
                              $('#campaign_monitor_list_id').append($('<option></option>').attr("value", index).text(value));
                            });
                        }
                        
                        if(response.error){
                            
                        }

                        $('#campaign_monitor_list_id').removeAttr('disabled');
                   }
                   else {
                      alert("Somthing Wrong");
                   }
                }
             });   
        });
        
        
        
    });
</script>
<?php
        
    }
    
    public function changeClient(){
        $result['type'] = '';
        $key = isset($_REQUEST['key']) ? stripslashes($_REQUEST['key']) : '';
        
        if($key != '') {
            $result['type'] = 'success';
            $options = get_option('wpdm_email_campaign_monitor');
            $options['key'] = $key;
            update_option('wpdm_email_campaign_monitor', $options);
            
            $list = $this->api->getClients();
            if(is_array($list)) {
                $result['options'] = $list;
            }
            else {
                $result['error'][] = '<strong>API ERROR</strong>! Invalid API Key or No Client Found.';
            }
        }
        
        
        
        //echo result 
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $result = json_encode($result);
            echo $result;
         }
         else {
            header("Location: ".$_SERVER["HTTP_REFERER"]);
         }

         die();
    }
    
    public function changeList(){
        $result['type'] = '';
        $client_id = isset($_REQUEST['client_id']) ? stripslashes($_REQUEST['client_id']) : '';
        
        if($client_id != '') {
            $result['type'] = 'success';
            $options = get_option('wpdm_email_campaign_monitor');
            $options['client_id'] = $client_id;
            update_option('wpdm_email_campaign_monitor', $options);
            
            $list = $this->api->getLists($client_id);
            if(is_array($list)) {
                $result['options'] = $list;
            }
            else {
                $result['error'][] = '<strong>API ERROR</strong>! Invalid API Key and or Invalid Client ID.';
            }
        }
        
        
        
        //echo result 
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $result = json_encode($result);
            echo $result;
         }
         else {
            header("Location: ".$_SERVER["HTTP_REFERER"]);
         }

         die();
    }
       
    public function subscribeHook($post, $file){
        $name = isset( $post['custom_form_field']['name'] ) ? $post['custom_form_field']['name'] : '';
        $email = $post['email'];
        $option = get_option('wpdm_email_campaign_monitor');
        $list_id = $option['list_id'];

        //if email is valid subscribe
        if( is_email($email) ){
            //check this mail already exist or not
            $utility = new WpdmEmailCampaignMonitorUtility();

            if($utility->subscribeEmail($list_id, $email, $name)){
                //subscribe successfull
                //echo "success";
            }
            else {
                //subscribtion failed
                //echo "failed";
            }

        }
        
    }
}

WpdmEmailCampaignMonitor::getInstance();
