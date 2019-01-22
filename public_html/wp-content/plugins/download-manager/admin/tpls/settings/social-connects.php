<?php
/**
 * Date: 9/28/16
 * Time: 9:26 PM
 */
if(!defined('ABSPATH')) die('!');
?>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo __('Social Lock Panel','wpdmpro'); ?></div>
    <div class="panel-body">
        <div class="form-group">
            <label><?php echo __('Title','wpdmpro'); ?></label>
            <input type="text" class="form-control" name="_wpdm_social_lock_panel_title" value="<?php echo get_option('_wpdm_social_lock_panel_title', 'Like or Share to Download'); ?>">
        </div>
        <div class="form-group">
            <label><?php echo __('Description','wpdmpro'); ?></label>
            <input type="text" class="form-control" name="_wpdm_social_lock_panel_desc" value="<?php echo get_option('_wpdm_social_lock_panel_desc', 'Please support us, use one of the buttons below to unlock the download link.'); ?>">
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo __('Linkedin App Settings','wpdmpro'); ?></div>
    <div class="panel-body">
    <div class="form-group">
        <label><a name="fbappid"></a><?php echo __('Facebook APP ID','wpdmpro'); ?></label>
        <input type="text" class="form-control" name="_wpdm_facebook_app_id" value="<?php echo get_option('_wpdm_facebook_app_id'); ?>">
        <em>Create new facebook app from <a target="_blank" href='https://developers.facebook.com/apps'>here</a></em>
    </div>
        <div class="form-group">
        <label><a name="fbappid"></a><?php echo __('Facebook APP Secret','wpdmpro'); ?></label>
        <input type="text" class="form-control" name="_wpdm_facebook_app_secret" value="<?php echo get_option('_wpdm_facebook_app_secret'); ?>">
    </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo __('Linkedin App Settings','wpdmpro'); ?></div>
    <div class="panel-body">
    <div class="form-group">
        <label><a name="liappid"></a><?php echo __('LinkedIn Client ID','wpdmpro'); ?></label>
        <input type="text" class="form-control" name="_wpdm_linkedin_client_id" value="<?php echo get_option('_wpdm_linkedin_client_id'); ?>">
        <em>Create new linkedin app from <a target="_blank" href='https://www.linkedin.com/developer/apps'>here</a></em>
    </div>
    <div class="form-group">
        <label><a name="liappid"></a><?php echo __('LinkedIn Client Secret','wpdmpro'); ?></label>
        <input type="text" class="form-control" name="_wpdm_linkedin_client_secret" value="<?php echo get_option('_wpdm_linkedin_client_secret'); ?>">
        <em>Create new linkedin app from <a target="_blank" href='https://www.linkedin.com/developer/apps'>here</a></em>
    </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading"><?php echo __('Twitter App Settings','wpdmpro'); ?></div>
    <div class="panel-body">
    <div class="form-group">
        <label><a name="liappid"></a><?php echo __('Access Token','wpdmpro'); ?></label>
        <input type="text" class="form-control" name="_wpdm_twitter_access_token" value="<?php echo get_option('_wpdm_twitter_access_token'); ?>">
    </div>
    <div class="form-group">
        <label><a name="liappid"></a><?php echo __('Access Token Secret','wpdmpro'); ?></label>
        <input type="text" class="form-control" name="_wpdm_twitter_access_token_secret" value="<?php echo get_option('_wpdm_twitter_access_token_secret'); ?>">
    </div>
    <div class="form-group">
        <label><a name="liappid"></a><?php echo __('Consumer Key (API Key)','wpdmpro'); ?></label>
        <input type="text" class="form-control" name="_wpdm_twitter_api_key" value="<?php echo get_option('_wpdm_twitter_api_key'); ?>">
    </div>
    <div class="form-group">
        <label><a name="liappid"></a><?php echo __('Consumer Secret (API Secret)','wpdmpro'); ?></label>
        <input type="text" class="form-control" name="_wpdm_twitter_api_secret" value="<?php echo get_option('_wpdm_twitter_api_secret'); ?>">
    </div>
    </div>
</div>
