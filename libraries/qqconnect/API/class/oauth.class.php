<?php
require_once QQCONNECT . '/API/class/recorder.class.php';
require_once QQCONNECT . '/API/class/url.class.php';
require_once QQCONNECT . '/API/class/error.class.php';

class Oauth {
	const GET_AUTHORIZATION_CODE_URL = "https://graph.qq.com/oauth2.0/authorize";
	const GET_ACCESS_TOKEN_URL = "https://graph.qq.com/oauth2.0/token";
	const GET_OPENID_URL = "https://graph.qq.com/oauth2.0/me";

	protected $recorder;
	protected $url;
	protected $error;
	function __construct() {
		$this->recorder = new Recorder();
		$this->url = new Url();
		$this->error = new Error();
	}

	public function qq_login() {
		$appid = $this->recorder->readInc('appid');
		$callback = $this->recorder->readInc('callback');
		$scope = $this->recorder->readInc('scope');

		/*http://wiki.connect.qq.com/%E4%BD%BF%E7%94%A8authorization_code%E8%8E%B7%E5%8F%96access_token
		client端的状态值。用于第三方应用防止CSRF攻击，成功授权后回调时会原样带回。
		请务必严格按照流程检查用户与state参数状态的绑定。
		*/
		$state = md5(uniqid(rand()));
		$this->recorder->write('state', $state);

		$paramsArr = array(
			'response_type' => 'code', 
			'client_id' => $appid,
			'redirect_uri' => $callback,
			'state' => $state,
			'scope' => $scope
			);


		$login_request_url =  $this->url->build_url(self::GET_AUTHORIZATION_CODE_URL, $paramsArr);
	
		header("Location: {$login_request_url}");


	}

	public function qq_callback($back_state) {
		/*written into SESSION or array*/
		$state = $this->recorder->read('state');
		
		if(! $back_state || ! $state || $state != $back_state) {
			$this->error->showErrMsg(20000);
		}

		$client_id = $this->recorder->readInc('appid');
		$client_secret = $this->recorder->readInc('client_secret');
		$redirect_uri = $this->recorder->readInc('callback');
		$paramsArr = array(
				'grant_type' => 'authorization_code',
				'client_id' => $client_id,
				'client_secret' => $client_secret,
				'code' => $_GET['code'],
				'redirect_uri' => $redirect_uri
			);
		$request_url = $this->url->build_url(self::GET_ACCESS_TOKEN_URL, $paramsArr);
		//"access_token=ED3DD45689C819F1BE6FBA50E57A59A5&expires_in=7776000&refresh_token=496B202D9FD1DE6EB85C91AE93A44B16" 
		$content = $this->url->make_request($request_url);

		if(strpos($content, 'callback') !== false) {
			$lpos = strpos($content, '(');
			$rpos = strrpos($content, ')');
			$json_content = substr($content, $lpos + 1, $rpos- $lpos - 1);
			$msg = json_decode($json_content);

			if(isset($msg->error)) {
				$this->error->showErrMsg($msg->error, $msg->error_description);
			}
		}

		$params = array();
		parse_str($content, $params);

		$access_token = $params['access_token'];

		$this->recorder->write('access_token', $access_token);

		return $access_token;
	}

	public function get_openid($access_token = '') {

		$access_token = $access_token ? : $this->recorder->read('access_token');
		$paramsArr = array(
				'access_token' => $access_token,
			);

		$request_url = $this->url->build_url(self::GET_OPENID_URL, $paramsArr);

		$content = $this->url->make_request($request_url);

		if(strpos($content, 'callback') !== false) {
			$lpos = strpos($content, '(');
			$rpos = strrpos($content, ')');
			$json_content = substr($content, $lpos + 1, $rpos- $lpos - 1);
			$msg = json_decode($json_content);

			if(isset($msg->error)) {
				$this->error->showErrMsg($msg->error, $msg->error_description);
			}
		}

		//object(stdClass)#17 (2) { ["client_id"]=> string(9) "310033675" ["openid"]=> string(32) "AA3F7A8ED93E1B04FE4D9741C42ADC93" } 
		$openid = $msg->openid;
		$this->recorder->write('openid', $openid);
		return $openid;

	}
	
}