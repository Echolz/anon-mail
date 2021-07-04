<?php 
	include './email.php';

	if(isset($_GET["id"]))
	{
		$id = $_GET["id"];
	}
	
	$result = getEmailById($id);

	
?>

<!DOCTYPE html>
<html lang="bg">

<head>
    <title>Съобщение</title>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
    <link rel="stylesheet" type="text/css" href="css/emails.css">
	<link rel="stylesheet" href="css/include.css">
</head>

<body>
	<header id="page-header">
		<div class="header-item" id="icon_header_container">
			<a href="index.html">
				<img class="icon" id="logo_img" src="img/logo.png" alt="Лого">
			</a>
		</div>
		<div class="header-item" id="emails_header_container">
			<a id="sign_in" class="header-a" href="login.html">Вход</a>
			<a id="register"  class="header-a" href="register.html">Регистрация</a>
			<img class="icon" id="profile_img" src="img/account.png" alt="Икона на потребителски профил" onclick="profileRedirect('takeAndDeliver')">
		</div>
	</header>
		<main id="emails">
			<nav class="emails-menu">
                <header class="inner-header">
                    <p>Навигация</p>
                </header>
                <div class="emails-menu-item" id="newEmail">
                    <a href="newEmail.html">Ново съобщение</a>
                </div>
                <div class="emails-menu-item" id="send">
                    <a href="sendEmailsView.php">Изпратени</a>
                </div>
				<div class="emails-menu-item" id="received">
                    <a href="receivedEmailsView.php">Получени</a>
                </div>
				<div class="emails-menu-item" id="anonReceived">
                    <a href="anonReceivedEmailsView.php">Анонимно получени</a>
                </div>
            </nav>
            <div class="emails-page-wrapper">
                <div class="emails-page">
					<form class="emails-menu-item" id="emails_ocerview">
						<header class="emails_header">
							<h1>Съобщение</h1>
						</header>
						<hr>
						<div class="grid-container emails-section" id="overview_main">
							<div class="field one-row">
								<label for="theme">Тема:</label>
								<input type="text" name="theme" id="theme" value="<?php echo $result['subject'] ?>" disabled>
							</div>
							<div class="field one-row">
								<label for="from">От:</label>
								<input type="text" name="from" id="from" value="<?php echo $result['from_'] ?>" disabled>
							</div>
							<div class="field one-row">
								<label for="to">До:</label>
								<input type="text" name="to" id="to" value="<?php echo $result['to_'] ?>" disabled>
							</div>
							<div class="field one-row">
								<label for="date">Дата:</label>
								<input type="text" name="date" id="date" value="<?php echo "21-21-2021" ?>" disabled>
							</div>
						</div>
						<div class="grid-container emails-section" id="overview_main">
							<div class="field one-row">
								<label for="content">Съдържание:</label>
								<textarea rows="20" name="content" id="content" disabled><?php echo $result['content'] ?></textarea>
							</div>
						</div>
					</form>
                </div>
            </div>
        </main>

</body>

</html>
