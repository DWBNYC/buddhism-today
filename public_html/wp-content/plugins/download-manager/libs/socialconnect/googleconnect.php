<?php
namespace WPDM;
require_once dirname( __FILE__ ) . '/Google/autoload.php';


class GoogleConnect {

	function __construct() {
		add_action( 'init', array( $this, 'ConnectHelper' ) );
	}

	public static function LoginURL(){
		$loginUrl    = home_url('/?connect=google');
		echo $loginUrl;
	}

	function ConnectHelper() {

		if(!isset($_GET['connect']) || $_GET['connect'] != 'google') return;

		if(isset($_GET['plus'])){

			$pid = (int)$_GET['package'];
			$var = md5('visitor.' . $_SERVER['REMOTE_ADDR'] . '.' . $pid . '.' . md5(get_permalink($pid)));

			$href = get_post_meta($pid,'__wpdm_google_plus_1', true);

			$href = $href ? $href : get_permalink($pid);
			$dlabel =  __('Download', 'wpdmpro');

			//update_post_meta(get_the_ID(),$var,$package['download_url']);

			$data = '<div class="g-plusone" data-href="' . $href . '" data-callback="wpdm_plus1st_unlock_' . $pid . '"></div>';
			$req = home_url('/?pid=' . $pid . '&var=' . $var);
			$home = home_url('/');
			$force = str_replace("=", "", base64_encode("unlocked|" . date("Ymdh")));
			$jquery = includes_url("/js/jquery/jquery.js");
			$html = <<<DATA
               <html>
               <title>Google +1</title>
               <script src="{$jquery}"></script>
               <body>
                 <div style="padding:140px;text-align: center;">

                $data



                <script type="text/javascript">
                  (function() {
                    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                    po.src = 'https://apis.google.com/js/plusone.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                  })();

                  function wpdm_plus1st_unlock_$pid(plusone){

                        var ctz = new Date().getMilliseconds();
                        jQuery.post("{$home}?nocache="+ctz,{id:{$pid},dataType:'json',execute:'wpdm_getlink',force:'$force',social:'g',action:'wpdm_ajax_call'},function(res){
                            if(res.downloadurl!=""&&res.downloadurl!=undefined) {
                            window.parent.location.href=res.downloadurl;
                            jQuery('#wpdmslb-googleplus-{$pid}').addClass('wpdm-social-lock-unlocked').html('<a href="'+res.downloadurl+'" class="wpdm-download-button btn btn-inverse btn-block">{$dlabel}</a>');

                            } else {
                                jQuery("#msg_{$pid}").html(""+res.error);
                            }
                    }, "json");


                  }

                </script></div></body></html>



DATA;
			echo $html;
			die();
		}

		$social_settings = get_option( "mj_social_settings", array() );

		$client = new Google_Client();
		$client->setApplicationName('Connect with Google');
		$client->setClientId($social_settings['google_client_id']);
		$client->setClientSecret($social_settings['google_client_secret']);
		$client->setRedirectUri(home_url('/?connect=google'));
		//$client->setScopes(array('https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/plus.me'));      // Important!
		$client->setScopes('email');


		if (isset($_GET['code'])) {
			$client->authenticate($_GET['code']);
			$_SESSION['access_token'] = $client->getAccessToken();
			header('Location: ' . home_url('/?connect=google'));
		}

		if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
			$client->setAccessToken($_SESSION['access_token']);
		} else {
			$authUrl = $client->createAuthUrl();
			header("location: ".$authUrl);
			die();
		}

		if ($client->getAccessToken()) {
			$_SESSION['access_token'] = $client->getAccessToken();
			$token_data = $client->verifyIdToken()->getAttributes();
			$oauth2 = new Google_Service_Oauth2($client);
			$user = $oauth2->userinfo->get();

		}

		$user_email = $user->getEmail();

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
			$user_login = sanitize_user($user->getName(), true);
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
			//update_user_meta($user_id, 'first_name', $user->getName());
			//update_user_meta($user_id, 'last_name', $user->getName());
			update_user_meta($user_id, 'nickname', $display_name);
			//update_user_meta($user_id, 'description', $user->getField('bio'));
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

new GoogleConnect();