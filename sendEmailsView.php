<!DOCTYPE html>
<html lang="bg">

<head>
    <title>Изпратени имайли</title>
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
                    <header class="emails_header">
                        <h1>Изпратени съобщения</h1>
                    </header>
                    <hr>
                    <form class="emails-item" id="emails_overview">
						<table border="0" cellspacing="2" cellpadding="2"> 
							<tr> 
							  <td> <font face="Arial">Тема</font> </td> 
							  <td> <font face="Arial">До</font> </td> 
							  <td> <font face="Arial">Дата</font> </td>
							  <td> <font face="Arial">Идентификационен номер</font> </td> 
						    </tr>
						<?php 
							include './email.php';
							
							// The variable should point to the currently logged in user
							$userName = "ikbal";
							$result = getSendEmails($userName);
							
							foreach ($result as $row) {
								$id = $row["id"];
								$to = $row["to_"];
								$subject = $row["subject"]; 
								$date = $row["sendTime"];

								echo '<tr>
										  <td><a href="emailView.php?id='.$id.'" style="color: #black; text-decoration: none;">'.$subject.'</a></td>
										  <td><a href="emailView.php?id='.$id.'" style="color: #black; text-decoration: none;">'.$to.'</a></td>
										  <td><a href="emailView.php?id='.$id.'" style="color: #black; text-decoration: none;">'.$date.'</a></td> 
										  <td><a href="emailView.php?id='.$id.'" style="color: #black; text-decoration: none;">'.$id.'</a></td>
									  </tr>';
							}
						?>
                    </form>
                </div>
            </div>
        </main>

</body>

</html>