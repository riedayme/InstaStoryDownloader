<?php 

/**
* InstagramClass Story Version
* 10 February 2022
* Made by FaanTeyki
*/
class InstagramStory
{
	
	protected $auth;
	
	protected $base = "https://www.instagram.com";
	protected $apibase = "https://i.instagram.com/api/v1/";
	protected $headers = [
	'Connection: keep-alive',
	'Sec-Ch-Ua: "Not A;Brand";v="99", "Chromium";v="98", "Google Chrome";v="98"',
	'Sec-Ch-Ua-Mobile: ?0',
	'Sec-Ch-Ua-Platform: Windows',
	'Upgrade-Insecure-Requests: 1',
	'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.82 Safari/537.36',
	'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
	'Sec-Fetch-Site: none',
	'Sec-Fetch-Mode: navigate',
	'Sec-Fetch-User: ?1',
	'Sec-Fetch-Dest: document',
	'Accept-Language: en-US,en;q=0.9,id;q=0.8'
	];


	protected $proxy = false;

	function __construct($data = [])
	{

		if (array_key_exists('cookie', $data)) {
			$this->headers = array_merge($this->headers, ['Cookie: '.$data['cookie']]);
		}
		
		if (array_key_exists('proxy', $data)) {
			$this->proxy = $data['proxy'];
		}
	}

	/**
	 * Helper
	 */
	protected function Fetch($url, $postdata = 0, $header = 0, $cookie = 0, $useragent = 0, $proxy = array(), $followlocation = 0) 
	{

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $followlocation);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_VERBOSE, false);
		curl_setopt($ch, CURLOPT_HEADER, 1);

		if($header) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch, CURLOPT_ENCODING, "gzip");
		}

		if($postdata) {
			curl_setopt($ch, CURLOPT_POST, 1);
			if ($postdata != 'empty') {
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
			}
		}

		if($cookie) {
			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
			curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
		}

		if ($useragent) {
			curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
		}

		if (!empty($proxy['proxy']['ip'])){
			curl_setopt($ch, CURLOPT_PROXY, $proxy['proxy']['ip']);
		}

		if (!empty($proxy['proxy']['userpwd'])){
			curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy['proxy']['userpwd']);
		}

		if (!empty($proxy['proxy']['socks5'])){
			curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
		}

		$response = curl_exec($ch);
		$httpcode = curl_getinfo($ch);

		if (curl_errno($ch)) {
			return [
			'status' => false,
			'response' => 'Connection 404'
			];
		}		

		if(!$httpcode) 
		{
			curl_close($ch);	
			
			return [
			'status' => false,
			'response' => 'HttpCode 404'
			];
		}
		else
		{
			$header = substr($response, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
			$body = substr($response, curl_getinfo($ch, CURLINFO_HEADER_SIZE));

			curl_close($ch);

			if (!$httpcode['http_code']) {
				return [
				'status' => false,
				'response' => 'HttpCode 404'
				];
			}

			return [
			'status' => true,
			'header' => $header,
			'body' => $body,
			'code' => $httpcode['http_code']
			];
		}
	}

	protected function FindStringOnArray($arr, $string) {
		return array_filter($arr, function($value) use ($string) {
			return strpos($value, $string) !== false;
		});
	}

	/**
	 * https://stackoverflow.com/questions/19420715/check-if-specific-array-key-exists-in-multidimensional-array-php
	 */
	protected function findKey($key,$arr) {
		if (!is_array($arr)) return false;
		if (array_key_exists($key, $arr)) {
			return true;
		}
		foreach ($arr as $element) {
			if (is_array($element)) {
				if (multiKeyExists($element, $key)) {
					return true;
				}
			}
		}
		return false;
	}	

	public function isJson($string) {
		json_decode($string);
		return json_last_error() === JSON_ERROR_NONE;
	}	

	/**
	 * Cookie
	 */
	protected function GetUIDCookie($cookies){

		$cookies_to_arr = explode(';', $cookies);
		$result = $this->FindStringOnArray($cookies_to_arr, 'ds_user_id');

		if (count($result) > 1) {
			$result = array_slice($result, 1);
		}

		$result_userid = implode("", $result);
		
		$userid = substr(trim($result_userid), 11);

		return $userid;
	}

	protected function GetCSRFCookie($cookies){
		$cookies_to_arr = explode(';', $cookies);
		$result = $this->FindStringOnArray($cookies_to_arr, 'csrftoken');
		if (count($result) > 1) {
			$result = array_slice($result, 1);
		}
		$result_csrftoken = implode("", $result);
		$csrftoken = substr(trim($result_csrftoken), 10);
		return $csrftoken;
	}

	public function ReadEditThisCookie($data)
	{
		$cookies = '';
		foreach (json_decode($data,TRUE) as $read) {
			$cookies .= "{$read['name']}={$read['value']};";
		}

		return $cookies;
	}

	/**
	 * File
	 */
	public static function DownloadByURL($url,$dir = './'){
		$ch		=	curl_init($url);
		$fileName		=	explode('?', basename($url))[0];
		$saveFilePath	=	$dir . $fileName;
		$fp				=	fopen($saveFilePath, 'wb');
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_exec($ch);
		curl_close($ch);	
		fclose($fp);

		return $fileName;
	}	

	/**
	 * Auth
	 */
	public function Auth($cookie){
		
		// set cookie on header for login
		$this->headers = array_merge($this->headers, ['Cookie: '.$cookie]);

		// get userinfo from cookie
		$userinfo = $this->UserInfo($cookie);
		if (!$userinfo['status']) return $userinfo;

		// checking
		$url = $this->base.'/'.$userinfo['response']['username'].'/?__a=1';

		$connect = $this->Fetch($url, false , $this->headers , false, false, $this->proxy);
		if (!$connect['status']) return $connect;

		if (!$this->isJson($connect['body'])) {
			return [
			'status' => false,
			'response' => 'Response Invalid'
			];	
		}

		$result = json_decode($connect['body']);

		if(is_object($result) AND $result->graphql->user->restricted_by_viewer === false){

			return [
			'status' => true,
			'response' => [
			'userid' => $userinfo['response']['userid'],
			'username' => $userinfo['response']['username'],
			'photo' => $userinfo['response']['photo'],
			'cookie' => $cookie,
			'csrftoken' => $this->GetCSRFCookie($cookie)
			]
			];

		}else{

			return [
			'status' => false,
			'response' => 'Cookie Invalid'
			];		

		}

	}

	protected function UserInfo($cookie)
	{

		// get userid
		$userid =  $this->GetUIDCookie($cookie);
		if (empty($userid)) {
			return [
			'status' => false,
			'response' => 'UserID not Found, Are you sure this is  Cookie Instagram ?'
			];			
		} 

		$url = $this->base.'/graphql/query/?query_hash=7c16654f22c819fb63d1183034a5162f&variables={"user_id":"'.$userid.'","include_chaining":false,"include_reel":true,"include_suggested_users":false,"include_logged_out_extras":false,"include_highlight_reels":false}';

		$connect = $this->Fetch($url, false , $this->headers , false, false, $this->proxy);
		if (!$connect['status']) return $connect;

		if (!$this->isJson($connect['body'])) {
			return [
			'status' => false,
			'response' => 'Response Invalid'
			];	
		}

		$response = json_decode($connect['body'],true);

		if ($response['status'] == 'ok') {

			if ($response['data']['user'] != null) {

				$username = $response['data']['user']['reel']['owner']['username'];
				$photo = $response['data']['user']['reel']['owner']['profile_pic_url'];

				return [
				'status' => true,
				'response' => [
				'userid' => $userid,
				'username' => $username,
				'photo' => $photo
				]		
				];

			}else{
				return [
				'status' => false,
				'response' => 'No user Found'
				];				
			}		
		}else{

			return [
			'status' => false,
			'response' => $connect['body']
			];

		}		
	}


	/**
	 * Story
	 */
	protected function UserID($username) 
	{
		$url = $this->base."/{$username}/?__a=1";

		$connect = $this->Fetch($url, false , $this->headers , false, false, $this->proxy);
		if (!$connect['status']) return $connect;

		if (strpos($connect['body'], 'DOCTYPE html')) {
			return [
			'status' => false,
			'response' => 'Cookie Invalid'
			];
		}else{				

			if (!$this->isJson($connect['body'])) {
				return [
				'status' => false,
				'response' => 'Response Invalid'
				];	
			}

			$response = json_decode($connect['body'],true);

			if ($this->findKey('graphql', $response)) {
				return [
				'status' => true,
				'response' => $response['graphql']['user']['id']
				];
			}else{
				return [
				'status' => false,
				'response' => "User not found"
				];
			}

		}
	}

	public function FeedStory($username)
	{

		// get userid
		$userid = $this->UserID($username);
		if (!$userid['status']) return $userid;
		$userid = $userid['response'];

		// get story
		$url = $this->apibase."feed/user/{$userid}/story/";

		// set headers
		$this->headers = array_merge($this->headers, [
			// 'X-Ig-Www-Claim: hmac.AR2sQMxsgNFPzh-C8AImL3f8L68GuOzLVAEn7wXHAeEcnGgc',
			'X-Ig-App-Id: 936619743392459'
			]);

		$connect = $this->Fetch($url, false , $this->headers , false, false, $this->proxy);
		if (!$connect['status']) return $connect;

		if (!$this->isJson($connect['body'])) {
			return [
			'status' => false,
			'response' => 'Response Invalid'
			];	
		}

		$response = json_decode($connect['body'],true);


		if ($response['reel'] == null) {
			return [
			'status' => false,
			'response' => 'Story not Found, maybe has deleted'
			];	
		}

		/**
		 * Extract
		 */
		$extract = array();
		foreach ($response['reel']['items'] as $story) {

			$id = $story['pk'];
			$type = ($story['media_type'] == '1') ? 'image' : 'video';
			$media = ($type == 'image') ? $story['image_versions2']['candidates'][0]['url'] : $story['video_versions'][0]['url'];
			$thumbnail = $story['image_versions2']['candidates'][3]['url'];
			$taken_at = $story['taken_at'];

			/** get polling,question,and other here if exist */
			$story_data = []; /* reset value */
			$story_data['type'] = 'default';

			if (array_key_exists('story_questions', $story)) 
			{

				$read_questions = $story['story_questions'][0]['question_sticker'];

				$story_data['type'] = 'questions';
				$story_data['id'] = $read_questions['question_id'];
				$story_data['question'] = $read_questions['question'];
				$story_data['can_reply'] = $story['can_reply'];
			}

			elseif (array_key_exists('story_polls', $story)) 
			{

				$read_polls = $story['story_polls'][0]['poll_sticker'];

				$story_data['type'] = 'polls';
				$story_data['id'] = $read_polls['poll_id'];
				$story_data['question'] = $read_polls['question'];
				$story_data['can_reply'] = $story['can_reply'];
				$story_data['viewer_vote'] = (!empty($read_polls['viewer_vote']) ? true : false);				
			}		

			elseif (array_key_exists('story_countdowns', $story)) 
			{

				$read_countdowns = $story['story_countdowns'][0]['countdown_sticker'];

				$story_data['type'] = 'countdowns';
				$story_data['id'] = $read_countdowns['countdown_id'];
				$story_data['text'] = $read_countdowns['text'];
				$story_data['can_reply'] = $story['can_reply'];
			}

			elseif (array_key_exists('story_sliders', $story)) 
			{

				$read_sliders = $story['story_sliders'][0]['slider_sticker'];

				$story_data['type'] = 'sliders';
				$story_data['id'] = $read_sliders['slider_id'];
				$story_data['question'] = $read_sliders['question'];
				$story_data['can_reply'] = $story['can_reply'];
				$story_data['viewer_vote'] = (!empty($read_sliders['viewer_vote']) ? true : false);		
			}	

			elseif (array_key_exists('story_quizs', $story)) 
			{

				$read_quizs = $story['story_quizs'][0]['quiz_sticker'];

				$story_data['type'] ='quizs';
				$story_data['id'] = $read_quizs['quiz_id'];
				$story_data['question'] = $read_quizs['question'];
				$story_data['count_question'] = count($read_quizs['tallies']);	
				$story_data['can_reply'] = $story['can_reply'];
				$story_data['viewer_answer'] = (!empty($read_quizs['viewer_answer']) ? true : false);		
			}					

			$extract[] = [
			'id' => $id,
			'media' => $media,
			'thumbnail' => $thumbnail,			
			'type' => $type,
			'taken_at' => $taken_at,
			'story_detail' => $story_data,						
			];

		}	

		return [
		'status' => true,
		'response' => $extract
		];	
	}	
}