<?php
namespace WPDM;

require_once dirname( __FILE__ ) . '/Facebook/autoload.php';



class FacebookConnect {

	function __construct() {
		add_action( 'init', array( $this, 'ConnectHelper' ) );
	}

	public static function LoginURL(){
		$social_settings = get_option( "mj_social_settings", array() );
		$fb = new \Facebook\Facebook( [
			'app_id'                => get_option('_wpdm_facebook_app_id', 0),
			'app_secret'            => get_option('_wpdm_facebook_app_secret', 0),
			'default_graph_version' => 'v2.2',
		] );

		$helper = $fb->getRedirectLoginHelper();

		$permissions = [ 'email' ]; // Optional permissions
		$loginUrl    = $helper->getLoginUrl( home_url('/?connect=facebook'), $permissions );
		echo $loginUrl;
	}

	function ConnectHelper() {

		if(!isset($_GET['connect']) || $_GET['connect'] != 'facebook') return;

		if(isset($_GET['like'])){
			$this->likeButon($_GET['package']);
			die();
		}

		$social_settings = get_option( "mj_social_settings", array() );
		$fb = new \Facebook\Facebook( [
			'app_id'                => get_option('_wpdm_facebook_app_secret', 0),
			'app_secret'            => get_option('_wpdm_facebook_app_secret', 0),
			'default_graph_version' => 'v2.2',
		] );

		$helper = $fb->getRedirectLoginHelper();


		if(!isset($_GET['code']) && !isset($_GET['access_token'])){
			$permissions = [ 'email' ]; // Optional permissions
			$loginUrl    = $helper->getLoginUrl( home_url('/?connect=facebook'), $permissions );
			header("Location: ".$loginUrl);
			die();
		}


		try {
			$accessToken = isset($_GET['access_token'])?!isset($_GET['access_token']):$helper->getAccessToken();
		} catch ( \Facebook\Exceptions\FacebookResponseException $e ) {
			// When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch ( \Facebook\Exceptions\FacebookSDKException $e ) {
			// When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		if ( ! isset( $accessToken ) ) {
			if ( $helper->getError() ) {
				header( 'HTTP/1.0 401 Unauthorized' );
				echo "Error: " . $helper->getError() . "\n";
				echo "Error Code: " . $helper->getErrorCode() . "\n";
				echo "Error Reason: " . $helper->getErrorReason() . "\n";
				echo "Error Description: " . $helper->getErrorDescription() . "\n";
			} else {
				header( 'HTTP/1.0 400 Bad Request' );
				echo 'Bad request';
			}
			exit;
		}



		$_SESSION['fb_access_token'] = $accessToken->getValue();

		$data = $fb->get("/me?fields=id,name,email,picture,bio,link,first_name,last_name",  $accessToken->getValue());
		$user = $data->getGraphUser();

		$user_email = $user->getField('email');
		$user_id = email_exists($user_email);
		if(intval($user_id) > 0) {
			$euser = get_user_by( 'id', $user_id );
			if( $user ) {
				wp_set_current_user( $user_id, $euser->user_login );
				wp_set_auth_cookie( $user_id );
				do_action( 'wp_login', $euser->user_login );
			}
		} else {

			$user_pass = wp_generate_password(12, false);
			$user_login = sanitize_user($user->getFirstName().$user->getLastName(), true);
			$sfx = '';
			$user_login_orgn = $user_login;
			while(username_exists($user_login_orgn.$sfx)){
				$user_login = $user_login_orgn.$sfx;
				if($sfx == '') $sfx = 0;
				else $sfx++;
			}

			$user_id = wp_create_user($user_login, $user_pass, $user_email);
			$display_name = $user->getName();
			wp_update_user( array( 'ID' => $user_id, 'display_name' => $display_name ) );
			update_user_meta($user_id, 'first_name', $user->getFirstName());
			update_user_meta($user_id, 'last_name', $user->getLastName());
			update_user_meta($user_id, 'nickname', $display_name);
			update_user_meta($user_id, 'description', $user->getField('bio'));
			$headers = "From: " . get_option('sitename') . " <" . get_option('admin_email') . ">\r\nContent-type: text/html\r\n";
			$message = file_get_contents(dirname(__FILE__) . '/templates/wpdm-new-user.html');
			$loginurl = $_POST['permalink'];
			$message = str_replace(array("[#support_email#]", "[#homeurl#]", "[#sitename#]", "[#loginurl#]", "[#name#]", "[#username#]", "[#password#]", "[#date#]"), array(get_option('admin_email'), site_url('/'), get_option('blogname'), $loginurl, $display_name, $user_login, $user_pass, date("M d, Y")), $message);

			if ($user_id) {
				wp_mail($user_email, "Welcome to " . get_option('sitename'), $message, $headers);

			}

			wp_set_current_user( $user_id, $user_login );
			wp_set_auth_cookie( $user_id );
			do_action( 'wp_login', $user_login );


		}

		$this->ClosePopup();

		die();

	}

	function likeButon($pid){
		$package = get_post_meta($pid);
		$url = get_post_meta($pid,'__wpdm_facebook_like', true);
		$url = $url ? $url : get_permalink($pid);
		$dlabel =  __('Download', 'wpdmpro');
		$force = str_replace("=", "", base64_encode("unlocked|" . date("Ymdh")));
		$unlockurl = home_url("/?id={$pid}&execute=wpdm_getlink&force={$force}&social=f");
		$jquery = includes_url("/js/jquery/jquery.js");

		?><!DOCTYPE html>
		<html>
		<head>
			<title>Facebook Like</title>
			<script src="<?php echo $jquery; ?>"></script>
		</head>
		<body>
		<div id="fb-root"></div>
		<div id="wpdmslb-facebooklike-<?php echo $pid; ?>" class="wpdm-social-lock-box wpdmslb-facebooklike" style="padding:150px 200px;">
			<div class="labell">
				<script>

					window.fbAsyncInit = function() {
						console.log(FB);
						FB.Event.subscribe('edge.create', function(href) {
							console.log("FB Like");
							console.log(href);

							jQuery.post("<?php echo home_url("/?nocache=".uniqid()); ?>",{id:<?php echo $pid; ?>,dataType:'json',execute:'wpdm_getlink',force:"<?php echo $force; ?>",social:'f',action:'wpdm_ajax_call'},function(res){
								if(res.downloadurl!=''&&res.downloadurl!='undefined'&&res!='undefined') {
									location.href=res.downloadurl;
									jQuery('#wpdmslb-facebooklike-<?php echo $pid; ?>').addClass('wpdm-social-lock-unlocked').html('<a href="'+res.downloadurl+'" class="wpdm-download-button btn btn-inverse btn-block">Download</a>');
								} else {
									jQuery('#msg_<?php echo $pid; ?>').html(''+res.error);
								}
							});
							return false;
						});
					};

					(function(d, s, id) {
						if(typeof FB != "undefined") return;
						var js, fjs = d.getElementsByTagName(s)[0];
						if (d.getElementById(id)) return;
						js = d.createElement(s); js.id = id;
						js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo get_option('_wpdm_facebook_app_id', 0); ?>";
						fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));
				</script>
				<div class="fb-like" data-layout="standard" data-action="like" data-size="large" data-show-faces="true" data-share="true" data-href="<?php echo $url; ?>" data-send="false" data-width="100" data-font="arial"></div>

				<style>.fb_edge_widget_with_comment{ max-height:20px !important; overflow:hidden !important;}</style>
			</div>
		</div>
		</body>
		</html>
		<?php

	}

	function ClosePopup(){
		?>

		<script>
			window.opener.location.reload();
			window.close();
		</script>

		<?php
		die();
	}



}

new FacebookConnect();