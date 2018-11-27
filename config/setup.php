<?php

session_start();

include 'connect.php';
if (isset($_SESSION['choice'])) {  
    $choice = $_SESSION['choice'];    
}
else
{
    $choice = '';
}

try {

    if ($choice == "droplikeitshot")
    {
        $sql = "DROP DATABASE IF EXISTS db_camagru";
        $conn->exec($sql);
        session_destroy();
    }

    $sql = "CREATE DATABASE db_camagru";        
    // use exec() because no results are returned
    $conn->exec($sql);

    $sql = "CREATE TABLE `db_camagru`.`users`
    ( `id` INT(11) NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(255) NOT NULL ,
    `surname` VARCHAR(255) NOT NULL ,
    `e_mail` VARCHAR(255) NOT NULL ,
    `password` VARCHAR(255) NOT NULL ,
    `account_verified` BOOLEAN NOT NULL DEFAULT FALSE,
    `verification_token` VARCHAR(255) NOT NULL,
    `last_login` DATETIME NOT NULL DEFAULT '1000-01-01 00:00:00',
    `email_notif` BOOLEAN NOT NULL DEFAULT TRUE,
    PRIMARY KEY (`id`)) ENGINE = InnoDB;";

    $conn->exec($sql);

    $sql = "CREATE TABLE `db_camagru`.`posts`
    ( `id` INT NOT NULL AUTO_INCREMENT ,
    `user_id` INT NOT NULL ,
    `image` VARCHAR(255) NOT NULL ,
    `post` TEXT NOT NULL ,
    `date` DATETIME NOT NULL DEFAULT '1000-01-01 00:00:00',
    PRIMARY KEY (`id`)) ENGINE = InnoDB;";

    $conn->exec($sql);

    $sql = "CREATE TABLE `db_camagru`.`likes` ( `id` INT(11) NOT NULL AUTO_INCREMENT ,
    `user_id` INT(11) NOT NULL , 
    `like_date` DATETIME NOT NULL DEFAULT '1000-01-01 00:00:00' ,
    `post_id` INT(11) NOT NULL ,
    PRIMARY KEY (`id`)) ENGINE = InnoDB;";

    $conn->exec($sql);

    $sql = "CREATE TABLE `db_camagru`.`comments` 
    ( `id` INT NOT NULL AUTO_INCREMENT , 
    `user_id` INT(11) NOT NULL , 
    `post_id` INT(11) NOT NULL , 
    `comment` TEXT NOT NULL , 
    `comment_date` DATETIME NOT NULL , 
    PRIMARY KEY (`id`)) ENGINE = InnoDB;";

    $conn->exec($sql);

    echo "Database created successfully<br>";
    }
catch(PDOException $e)
    {
    	echo $sql . "<br>" . $e->getMessage();
    	if (preg_match("/database exists/", $e->getMessage()) == 1) {
    		header('Location: db_recreate.php');
    	}
    }

$conn = null;
?>