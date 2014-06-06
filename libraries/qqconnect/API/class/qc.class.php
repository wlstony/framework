<?php
require_once QQCONNECT . '/API/class/oauth.class.php';

class QC extends Oauth {
	private $apiList;
	private $requestParameters;

	function __construct($access_token='', $openid='') {
		parent::__construct();
		$this->requestParameters = array(
					'oauth_consumer_key' => $this->recorder->readInc('appid'),
					'access_token' => $access_token ? : $this->recorder->read('access_token'),
					'openid' => $openid ? : $this->recorder->read('openid')

				);

		$this->apiList = array(
				'get_user_info' => array(
						'https://graph.qq.com/user/get_user_info',
						array('format' => 'json'),
						'GET',
					),

			);

	}

	public function  __call($name, $arg) {
		if(empty($this->apiList[$name])) {
			$this->error->showErrMsg('', $name . ' does not exist in API list!');
		}

		$request_url = $this->apiList[$name][0];
		$argsArr = $this->apiList[$name][1];
		$method = $this->apiList[$name][2] ? : 'GET';

		$response = $this->_callAPI('', $argsArr, $request_url, $method);

		return json_decode($response, true);


	}
	
	public function _callAPI($arr, $argsArr, $baseUrl, $method) {

		$requestParameters = $this->requestParameters; // basic paramters, get from __construct

		foreach((array)$argsArr as $key => $value) {

			$requestParameters[$key] = $value;
		}


		if($method == 'POST') {
			$response = $this->url->post($baseUrl, $requestParameters);
		}
		elseif($method == 'GET') {
			$response = $this->url->get($baseUrl, $requestParameters);
		}

		return $response;

	}
}