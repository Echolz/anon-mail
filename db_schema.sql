CREATE DATABASE IF NOT EXISTS `web-mail-project` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `web-mail-project`;

CREATE TABLE email_user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(256) NOT NULL,
    anonym_username VARCHAR(256) NOT NULL,
    password VARCHAR(256) NOT NULL,
    fn INT NOT NULL,
    name VARCHAR(256) NOT NULL,
    surname VARCHAR(256) NOT NULL,
	CONSTRAINT username_unique UNIQUE (username)
);

CREATE TABLE email (
    id INT AUTO_INCREMENT PRIMARY KEY,
    from_ VARCHAR(256) NOT NULL,
    to_ VARCHAR(256) NOT NULL,
    subject VARCHAR(256) NOT NULL,
    content VARCHAR(8192) NOT NULL,
	sendTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);