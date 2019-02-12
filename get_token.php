<title>Получить токен ВК</title>
<center><form action="?" method="POST">
<input name="user" placeholder="Логин" /><br>
<input name="pass" placeholder="Пароль" /><br>
<input type="submit" value="Получить токен" />
</form>
<?if(isset($_POST['user']) and isset($_POST['pass'])){
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$fgc = file_get_contents("https://oauth.vk.com/token?grant_type=password&client_id=2274003&client_secret=hHbZxrka2uZ6jB1inYsH&username=$user&password=$pass");
	$json = json_decode($fgc, 1);
	if(in_array("access_token", $json)){
		$accessToken = $json['access_token'];
		print("Вот Ваш токен: <font color=red>" . $accessToken . "</font>");
	}else{
		print("Данные неверные, либо какая-то ошибка, увы");
	}
}?>