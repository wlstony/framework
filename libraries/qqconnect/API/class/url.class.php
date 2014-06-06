<?php
require_once QQCONNECT . '/API/class/error.class.php';

class Url {

	private $error;

	public function __construct() {
		$this->error = new Error();
	}


	public function build_url($baseUrl, $params) {

		if(! $baseUrl || empty($params))  return;

		$tempArr = array();
		foreach ((array)$params as $key => $value) {
			$tempArr[] = "$key=$value";
		}

		return $baseUrl . "?" . implode('&', $tempArr);

	}

	public function make_request($url) {
		if(! $url) {
			$this->error->showErrMsg('', 'URL is missing!');
			return;
		}
		//远程读取某个东西，如果设置allow_url_fopen=OFF将其关闭，我们就没有办法远程读取
		if(ini_get('allow_url_fopen')) {
			$response = file_get_contents($url);
		}
		else {
			$ch = curl_init();
			/*FALSE to stop cURL from verifying the peer's certificate. Alternate certificates to verify against can be specified 
			with the CURLOPT_CAINFO option or a certificate directory can be specified with the CURLOPT_CAPATH option. 
			*/
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			/*TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly. */
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			/*The URL to fetch. This can also be set when initializing a session with curl_init(). */
			curl_setopt($ch, CURLOPT_URL, $url);

			curl_exec($ch);
			curl_close($ch);
		}

		if(empty($response)) {
			$this->error->showErrMsg(30000);
		}

		return $response;
	}

	public function get($url, $params) {
		$full_url = $this->build_url($url, $params);
		$content = $this->make_request($full_url);
		
		return $content;
	}

	public function post($url, $params, $flag = 0) {
		$ch = curl_init();
		if(! $flag) curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		/*TRUE to do a regular HTTP POST.*/
		curl_setopt($ch, CURLOPT_POST, TRUE);
		/*The full data to post in a HTTP "POST" operation.*/
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_URL, $url);

		$res = curl_exec($ch);
		curl_close();

		return $res;
	}


}