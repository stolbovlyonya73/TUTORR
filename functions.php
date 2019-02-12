<?
	function check($apiId, $apiKey, $login, $password, $captchaSid, $captchaKey){
		if($curl = curl_init()){
			curl_setopt($curl, CURLOPT_URL, "https://oauth.vk.com/token");
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=password&client_id=$apiId&client_secret=$apiKey&username=$login&password=$password&captcha_sid =$captchaSid&captcha_key=$captchaKey");
			$out = curl_exec($curl);
			curl_close($curl);
			return $out;
		}
	}
	function request($url, $params){
		if($curl = curl_init()){
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
			$out = curl_exec($curl);
			curl_close($curl);
			return $out;
		}
	}
	function sendVK($sendToken, $to, $title, $msg){
		if($curl = curl_init()){
			curl_setopt($curl, CURLOPT_URL, "https://api.vk.com/method/messages.send");
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, "user_id=$to&message=$msg&title=$title&access_token=$sendToken");
			$out = curl_exec($curl);
			curl_close($curl);
			return $out;
		}
	}	
?>