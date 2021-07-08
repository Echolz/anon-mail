<?php
	session_start();
	include './database.php';
	include './session.php';

	define("SUBJECT", "subject");
	define("TO", "to");
	define("DELIVERY_TYPE", "deliveryType");
	define("CONTENT", "content");

	$currentUser = getSessionValue();
	if ($_POST) {

		$subject = $_POST[SUBJECT];
		$to = $_POST[TO];
		
		if (userExists($to)) {
			
			$content = $_POST[CONTENT];
			$deliveryType = $_POST[DELIVERY_TYPE];
			
			if ($deliveryType == "anonymous") {
				$currentUser = getAnonName($currentUser);
			}

			insertEmail($currentUser, $to, $subject, $content);
		} else {
			// To be implemented
		}
	}
	
	$subject = "";
	if (isset($_GET["subject"])) {
		$subject = $_GET["subject"];
	}
	
	$to = "";
	if (isset($_GET["to"])) {
		$to = $_GET["to"];
	}
	
	$from = "";
	if (isset($_GET["from"])) {
		$from = $_GET["from"];
	}
		
	$fromAnon = getAnonName($currentUser);
	
	if ($currentUser != $from && $fromAnon != $from) {
		$to = $from;
	}
	
?>

<!DOCTYPE html>
<html lang="bg">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/emails.css">
	<link rel="stylesheet" href="css/include.css">
    </head>
    <body>
        <header id="page-header">
            <div class="header-item" id="icon_header_container">
                <a href="index.html">
                    <img class="icon" id="logo_img" src="img/logo.png" alt="Лого на TustMe">
                </a>
            </div>
            <div class="header-item" id="profile_header_container">
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
                    <header class="emails_header">
                        <h1>Ново съобщение</h1>
                    </header>
                    <hr>
                    <form class="emails-menu-item" id="emails_overview" method="POST" action="newEmail.php" enctype="multipart/form-data">
                        <header class="inner-header">
                            <p>Информация за съобщението</p>
                        </header>
                        <div class="grid-container emails-section" id="overview_main">
							<div class="field one-row">
								<label for="subject">Тема:</label>
								<input type="text" name="subject" value="<?php echo "$subject" ?>" id="subject">
							</div>
							<div class="field one-row">
								<label for="to">До(Анонимно ID при анонимен имейл):</label>
								<input type="text" name="to" value="<?php echo $to ?>" id="to">
							</div>
							<div class="radioTest">
								<input type="radio" style="color:blue;text-align:center" class="radioButton" id="visible" checked="checked" name="deliveryType" value="visible">
								<label for="visible" class="radioB">Видим имейл</label><br>
								<input type="radio" class="radioButton" id="anonymous" name="deliveryType" value="anonymous">
								<label for="anonymous" class="radioB">Анонимен имейл</label><br>
							</div>
                        </div>
						<header class="inner-header">
                            <p>Съдържание:</p>
                        </header>
						<div class="grid-container emails-section" id="overview_main">
							<div class="field one-row">
								<label for="content">Съдържание:</label>
								<textarea rows="20" name="content" id="content"></textarea>
							</div>
						</div>
						<div>
							<input type="submit" name="send" value="Изпрати">
						</div>
                    </form>
                </div>
            </div>
        </main>
    </body>
</html>