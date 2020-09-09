
DROP TABLE IF EXISTS `team`;
CREATE TABLE `team` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`order_index` INT UNSIGNED NULL DEFAULT NULL, 
	`online` TINYINT UNSIGNED NULL DEFAULT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `team_ci_team_member`;
CREATE TABLE `team_ci_team_member` ( 
	`id` INT NOT NULL, 
	`team_member_id` INT UNSIGNED NULL DEFAULT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `team_ci_team_member` ADD INDEX `team_ci_team_member_index_1` (`team_member_id`);


DROP TABLE IF EXISTS `team_controller_page_config`;
CREATE TABLE `team_controller_page_config` ( 
	`id` INT UNSIGNED NOT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `team_controller_page_config_teams`;
CREATE TABLE `team_controller_page_config_teams` ( 
	`team_controller_page_config_id` INT UNSIGNED NOT NULL, 
	`team_id` INT UNSIGNED NOT NULL, 
	PRIMARY KEY (`team_controller_page_config_id`, `team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `team_location`;
CREATE TABLE `team_location` ( 
	`id` INT NOT NULL AUTO_INCREMENT, 
	`name` VARCHAR(255) NULL DEFAULT NULL, 
	`street` VARCHAR(255) NULL DEFAULT NULL, 
	`zip` VARCHAR(255) NULL DEFAULT NULL, 
	`city` VARCHAR(255) NULL DEFAULT NULL, 
	`country` VARCHAR(255) NULL DEFAULT NULL, 
	`phone` VARCHAR(255) NULL DEFAULT NULL, 
	`email` VARCHAR(255) NULL DEFAULT NULL, 
	`homepage` VARCHAR(255) NULL DEFAULT NULL, 
	`order_index` INT NULL DEFAULT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci ;


DROP TABLE IF EXISTS `team_location_page_controller`;
CREATE TABLE `team_location_page_controller` ( 
	`id` INT NOT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci ;


DROP TABLE IF EXISTS `team_member`;
CREATE TABLE `team_member` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`first_name` VARCHAR(255) NULL DEFAULT NULL, 
	`last_name` VARCHAR(255) NULL DEFAULT NULL, 
	`email` VARCHAR(255) NULL DEFAULT NULL, 
	`phone` VARCHAR(255) NULL DEFAULT NULL, 
	`file_image` VARCHAR(255) NULL DEFAULT NULL, 
	`order_index` INT UNSIGNED NULL DEFAULT NULL, 
	`online` TINYINT UNSIGNED NULL DEFAULT NULL, 
	`path_part` VARCHAR(255) NULL DEFAULT NULL, 
	`mobile` VARCHAR(255) NULL DEFAULT NULL, 
	`location_id` INT NULL DEFAULT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `team_member` ADD INDEX `team_member_index_1` (`location_id`);


DROP TABLE IF EXISTS `team_member_page_controller`;
CREATE TABLE `team_member_page_controller` ( 
	`id` INT NOT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `team_member_page_controller_team_members`;
CREATE TABLE `team_member_page_controller_team_members` ( 
	`team_member_page_controller_id` INT NOT NULL, 
	`team_member_id` INT NOT NULL, 
	PRIMARY KEY (`team_member_page_controller_id`, `team_member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci ;


DROP TABLE IF EXISTS `team_member_t`;
CREATE TABLE `team_member_t` ( 
	`id` INT NOT NULL AUTO_INCREMENT, 
	`n2n_locale` VARCHAR(12) NULL DEFAULT NULL, 
	`team_member_id` INT UNSIGNED NULL DEFAULT NULL, 
	`function` VARCHAR(255) NULL DEFAULT NULL, 
	`description_html` TEXT NULL DEFAULT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `team_member_t` ADD INDEX `team_member_t_index_1` (`team_member_id`);


DROP TABLE IF EXISTS `team_member_teams`;
CREATE TABLE `team_member_teams` ( 
	`team_member_id` INT NOT NULL, 
	`team_id` INT NOT NULL, 
	PRIMARY KEY (`team_member_id`, `team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci ;


DROP TABLE IF EXISTS `team_page_controller`;
CREATE TABLE `team_page_controller` ( 
	`id` INT NOT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `team_page_controller_teams`;
CREATE TABLE `team_page_controller_teams` ( 
	`team_page_controller_id` INT UNSIGNED NOT NULL, 
	`team_id` INT UNSIGNED NOT NULL, 
	PRIMARY KEY (`team_page_controller_id`, `team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `team_t`;
CREATE TABLE `team_t` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`n2n_locale` VARCHAR(12) NULL DEFAULT NULL, 
	`team_id` INT UNSIGNED NULL DEFAULT NULL, 
	`name` VARCHAR(255) NULL DEFAULT NULL, 
	`description` TEXT NULL DEFAULT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `team_t` ADD INDEX `team_t_index_1` (`team_id`);

