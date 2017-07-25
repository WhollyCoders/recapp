<?php
$sql = "CREATE TABLE IF NOT EXISTS `mybod4god`.`weigh_ins2` (
 `wi_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
 `wi_competitor_id` INT UNSIGNED NOT NULL ,
 `wi_team_id` INT UNSIGNED NOT NULL ,
 `wi_begin` DECIMAL(4,1) NOT NULL ,
 `wi_previous` DECIMAL(4,1) NOT NULL ,
 `wi_current` DECIMAL(4,1) NOT NULL ,
 `wi_week_id` INT UNSIGNED NOT NULL ,
 `wi_notes` TEXT NOT NULL ,
 `wi_date_entered` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
 UNIQUE( `wi_competitor_id`, `wi_week_id`),
 PRIMARY KEY (`wi_id`)
 ) ENGINE = InnoDB;
";

$result = mysqli_query($connection, $sql);
if(!$result){echo("[ -CREATE WEIGH_INS TABLE- ] --- There has been an ERROR!!!");}
 ?>
