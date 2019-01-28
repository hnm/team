-- Mysql Backup of mdl_team
-- Date 2019-01-28T16:50:59+01:00
-- Backup by 

DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`internal_page_id` INT UNSIGNED NULL, 
	`external_url` VARCHAR(255) NULL, 
	`page_content_id` INT UNSIGNED NULL, 
	`subsystem_name` VARCHAR(255) NULL, 
	`online` TINYINT UNSIGNED NOT NULL DEFAULT '1', 
	`in_path` TINYINT NOT NULL DEFAULT '1', 
	`hook_key` VARCHAR(255) NULL, 
	`in_navigation` TINYINT NOT NULL DEFAULT '1', 
	`nav_target_new_window` TINYINT NOT NULL DEFAULT '0', 
	`lft` INT UNSIGNED NOT NULL, 
	`rgt` INT UNSIGNED NOT NULL, 
	`last_mod` DATETIME NULL, 
	`last_mod_by` INT UNSIGNED NULL, 
	`indexable` TINYINT UNSIGNED NOT NULL DEFAULT '1'
	, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;

INSERT INTO `page` (`id`, `internal_page_id`, `external_url`, `page_content_id`, `subsystem_name`, `online`, `in_path`, `hook_key`, `in_navigation`, `nav_target_new_window`, `lft`, `rgt`, `last_mod`, `last_mod_by`, `indexable`) 
VALUES ( '1',  NULL,  NULL,  '1',  NULL,  '1',  '1',  NULL,  '1',  '0',  '1',  '4',  '2019-01-28 16:41:01',  NULL,  '1'),
( '2', NULL, NULL, '2', NULL, '1', '1', NULL, '1', '0', '2', '3', '2019-01-28 16:41:01', NULL, '1');

DROP TABLE IF EXISTS `page_content`;
CREATE TABLE `page_content` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`subsystem_name` VARCHAR(255) NULL, 
	`page_controller_id` INT UNSIGNED NOT NULL, 
	`page_id` INT UNSIGNED NULL, 
	`ssl` TINYINT UNSIGNED NOT NULL
	, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;

INSERT INTO `page_content` (`id`, `subsystem_name`, `page_controller_id`, `page_id`, `ssl`) 
VALUES ( '1',  NULL,  '1',  NULL,  '0'),
( '2', NULL, '2', NULL, '0');

DROP TABLE IF EXISTS `page_content_t`;
CREATE TABLE `page_content_t` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`n2n_locale` VARCHAR(5) NOT NULL, 
	`se_title` VARCHAR(255) NULL, 
	`se_description` VARCHAR(500) NULL, 
	`se_keywords` VARCHAR(255) NULL, 
	`page_content_id` INT UNSIGNED NOT NULL
	, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `page_content_t` ADD UNIQUE INDEX `page_content_id_n2n_locale` (`page_content_id`, `n2n_locale`);

INSERT INTO `page_content_t` (`id`, `n2n_locale`, `se_title`, `se_description`, `se_keywords`, `page_content_id`) 
VALUES ( '1',  'de_CH',  NULL,  NULL,  NULL,  '1'),
( '2', 'de_CH', NULL, NULL, NULL, '2');

DROP TABLE IF EXISTS `page_controller`;
CREATE TABLE `page_controller` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`method_name` VARCHAR(255) NULL
	, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;

INSERT INTO `page_controller` (`id`, `method_name`) 
VALUES ( '1',  'teams'),
( '2', 'teams');

DROP TABLE IF EXISTS `page_controller_t`;
CREATE TABLE `page_controller_t` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`n2n_locale` VARCHAR(16) NOT NULL, 
	`page_controller_id` VARCHAR(128) NULL
	, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `page_controller_t` ADD UNIQUE INDEX `page_controller_id_n2n_locale` (`page_controller_id`, `n2n_locale`);

INSERT INTO `page_controller_t` (`id`, `n2n_locale`, `page_controller_id`) 
VALUES ( '1',  'de_CH',  '1'),
( '2', 'de_CH', '2');

DROP TABLE IF EXISTS `page_controller_t_content_items`;
CREATE TABLE `page_controller_t_content_items` ( 
	`page_controller_t_id` INT UNSIGNED NOT NULL, 
	`content_item_id` INT UNSIGNED NOT NULL
	, PRIMARY KEY (`page_controller_t_id`, `content_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `page_link`;
CREATE TABLE `page_link` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`type` VARCHAR(255) NULL, 
	`linked_page_id` INT UNSIGNED NULL, 
	`url` VARCHAR(255) NULL, 
	`label` VARCHAR(255) NULL
	, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `page_link` ADD INDEX `page_link_index_1` (`linked_page_id`);


DROP TABLE IF EXISTS `page_t`;
CREATE TABLE `page_t` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`n2n_locale` VARCHAR(12) NULL, 
	`name` VARCHAR(255) NULL, 
	`title` VARCHAR(255) NULL, 
	`path_part` VARCHAR(255) NULL, 
	`page_id` INT UNSIGNED NULL, 
	`active` TINYINT UNSIGNED NOT NULL DEFAULT '1'
	, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `page_t` ADD INDEX `path_part` (`path_part`);
ALTER TABLE `page_t` ADD INDEX `page_leaf_t_index_1` (`page_id`);

INSERT INTO `page_t` (`id`, `n2n_locale`, `name`, `title`, `path_part`, `page_id`, `active`) 
VALUES ( '1',  'de_CH',  'asdfasf',  'asdf',  'asdfasf',  '1',  '1'),
( '2', 'de_CH', 'adsfa', 'asdfas', 'adsfa', '2', '1');

DROP TABLE IF EXISTS `rocket_content_item`;
CREATE TABLE `rocket_content_item` ( 
	`id` INT NOT NULL AUTO_INCREMENT, 
	`panel` VARCHAR(32) NULL, 
	`order_index` INT NULL
	, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


DROP TABLE IF EXISTS `rocket_critmod_save`;
CREATE TABLE `rocket_critmod_save` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`ei_type_path` VARCHAR(255) NOT NULL, 
	`name` VARCHAR(255) NOT NULL, 
	`filter_data_json` TEXT NOT NULL, 
	`sort_data_json` TEXT NULL
	, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `rocket_critmod_save` ADD UNIQUE INDEX `name` (`name`);
ALTER TABLE `rocket_critmod_save` ADD INDEX `ei_spec_id` (`ei_type_path`);


DROP TABLE IF EXISTS `rocket_custom_grant`;
CREATE TABLE `rocket_custom_grant` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`custom_spec_id` VARCHAR(255) NOT NULL, 
	`rocket_user_group_id` INT UNSIGNED NOT NULL, 
	`full` TINYINT UNSIGNED NOT NULL DEFAULT '1', 
	`access_json` TEXT NOT NULL
	, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `rocket_custom_grant` ADD UNIQUE INDEX `script_id_user_group_id` (`custom_spec_id`, `rocket_user_group_id`);


DROP TABLE IF EXISTS `rocket_ei_grant`;
CREATE TABLE `rocket_ei_grant` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`ei_type_path` VARCHAR(255) NOT NULL, 
	`rocket_user_group_id` INT UNSIGNED NOT NULL, 
	`full` TINYINT UNSIGNED NOT NULL DEFAULT '1', 
	`access_json` TEXT NOT NULL
	, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `rocket_ei_grant` ADD UNIQUE INDEX `script_id_user_group_id` (`rocket_user_group_id`, `ei_type_path`);


DROP TABLE IF EXISTS `rocket_ei_grant_privileges`;
CREATE TABLE `rocket_ei_grant_privileges` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`ei_grant_id` INT UNSIGNED NOT NULL, 
	`ei_privilege_json` TEXT NOT NULL, 
	`restricted` TINYINT NOT NULL DEFAULT '0', 
	`restriction_group_json` TEXT NULL
	, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `rocket_login`;
CREATE TABLE `rocket_login` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`nick` VARCHAR(255) NULL, 
	`wrong_password` VARCHAR(255) NULL, 
	`power` ENUM('superadmin','admin','none') NULL, 
	`successfull` TINYINT UNSIGNED NOT NULL, 
	`ip` VARCHAR(255) NOT NULL DEFAULT '', 
	`date_time` DATETIME NOT NULL
	, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `rocket_user`;
CREATE TABLE `rocket_user` ( 
	`id` INT NOT NULL AUTO_INCREMENT, 
	`nick` VARCHAR(255) NOT NULL, 
	`firstname` VARCHAR(255) NULL, 
	`lastname` VARCHAR(255) NULL, 
	`email` VARCHAR(255) NULL, 
	`power` ENUM('superadmin','admin','none') NOT NULL DEFAULT 'none', 
	`password` VARCHAR(255) NOT NULL
	, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `rocket_user` ADD UNIQUE INDEX `nick` (`nick`);

INSERT INTO `rocket_user` (`id`, `nick`, `firstname`, `lastname`, `email`, `power`, `password`) 
VALUES ( '1',  'super',  'Testerich',  'von Testen',  'testerich@von-testen.com',  'superadmin',  '$2a$07$holeradioundholeradioe5FD29ANtu4PChE8W4mZDg.D1eKkBnwq');

DROP TABLE IF EXISTS `rocket_user_access_grant`;
CREATE TABLE `rocket_user_access_grant` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`script_id` VARCHAR(255) NOT NULL, 
	`restricted` TINYINT NOT NULL, 
	`privileges_json` TEXT NOT NULL, 
	`access_json` TEXT NOT NULL, 
	`restriction_json` TEXT NOT NULL, 
	`user_group_id` INT UNSIGNED NOT NULL
	, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `rocket_user_access_grant` ADD INDEX `user_group_id` (`user_group_id`);


DROP TABLE IF EXISTS `rocket_user_group`;
CREATE TABLE `rocket_user_group` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`name` VARCHAR(64) NOT NULL, 
	`nav_json` TEXT NULL
	, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `rocket_user_rocket_user_groups`;
CREATE TABLE `rocket_user_rocket_user_groups` ( 
	`rocket_user_id` INT UNSIGNED NOT NULL, 
	`rocket_user_group_id` INT UNSIGNED NOT NULL
	, PRIMARY KEY (`rocket_user_id`, `rocket_user_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `team`;
CREATE TABLE `team` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`order_index` INT UNSIGNED NULL, 
	`online` TINYINT UNSIGNED NULL
	, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;

INSERT INTO `team` (`id`, `order_index`, `online`) 
VALUES ( '1',  '10',  '1');

DROP TABLE IF EXISTS `team_ci_team_member`;
CREATE TABLE `team_ci_team_member` ( 
	`id` INT NOT NULL, 
	`team_member_id` INT UNSIGNED NULL
	, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `team_ci_team_member` ADD INDEX `team_ci_team_member_index_1` (`team_member_id`);


DROP TABLE IF EXISTS `team_controller_page_config`;
CREATE TABLE `team_controller_page_config` ( 
	`id` INT UNSIGNED NOT NULL
	, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `team_controller_page_config_teams`;
CREATE TABLE `team_controller_page_config_teams` ( 
	`team_controller_page_config_id` INT UNSIGNED NOT NULL, 
	`team_id` INT UNSIGNED NOT NULL
	, PRIMARY KEY (`team_controller_page_config_id`, `team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `team_member`;
CREATE TABLE `team_member` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`first_name` VARCHAR(255) NULL, 
	`last_name` VARCHAR(255) NULL, 
	`email` VARCHAR(255) NULL, 
	`phone` VARCHAR(255) NULL, 
	`file_image` VARCHAR(255) NULL, 
	`order_index` INT UNSIGNED NULL, 
	`online` TINYINT UNSIGNED NULL
	, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;

INSERT INTO `team_member` (`id`, `first_name`, `last_name`, `email`, `phone`, `file_image`, `order_index`, `online`) 
VALUES ( '1',  'Thomas',  'Günther',  NULL,  NULL,  NULL,  '10',  '1');

DROP TABLE IF EXISTS `team_member_page_controller`;
CREATE TABLE `team_member_page_controller` ( 
	`id` INT NOT NULL
	, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `team_member_page_controller_team_members`;
CREATE TABLE `team_member_page_controller_team_members` ( 
	`team_member_page_controller_id` INT UNSIGNED NOT NULL, 
	`team_member_id` INT UNSIGNED NOT NULL
	, PRIMARY KEY (`team_member_page_controller_id`, `team_member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `team_member_t`;
CREATE TABLE `team_member_t` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`n2n_locale` VARCHAR(12) NULL, 
	`team_member_id` INT UNSIGNED NULL, 
	`function` VARCHAR(255) NULL
	, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `team_member_t` ADD INDEX `team_member_t_index_1` (`team_member_id`);

INSERT INTO `team_member_t` (`id`, `n2n_locale`, `team_member_id`, `function`) 
VALUES ( '1',  'de_CH',  '1',  'Hutzler');

DROP TABLE IF EXISTS `team_member_teams`;
CREATE TABLE `team_member_teams` ( 
	`team_member_id` INT UNSIGNED NOT NULL, 
	`team_id` INT UNSIGNED NOT NULL
	, PRIMARY KEY (`team_member_id`, `team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;

INSERT INTO `team_member_teams` (`team_member_id`, `team_id`) 
VALUES ( '1',  '1');

DROP TABLE IF EXISTS `team_page_controller`;
CREATE TABLE `team_page_controller` ( 
	`id` INT NOT NULL
	, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;

INSERT INTO `team_page_controller` (`id`) 
VALUES ( '1'),
( '2');

DROP TABLE IF EXISTS `team_page_controller_teams`;
CREATE TABLE `team_page_controller_teams` ( 
	`team_page_controller_id` INT UNSIGNED NOT NULL, 
	`team_id` INT UNSIGNED NOT NULL
	, PRIMARY KEY (`team_page_controller_id`, `team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `team_t`;
CREATE TABLE `team_t` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`n2n_locale` VARCHAR(12) NULL, 
	`team_id` INT UNSIGNED NULL, 
	`name` VARCHAR(255) NULL, 
	`description` TEXT NULL
	, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `team_t` ADD INDEX `team_t_index_1` (`team_id`);

INSERT INTO `team_t` (`id`, `n2n_locale`, `team_id`, `name`, `description`) 
VALUES ( '1',  'de_CH',  '1',  'Test',  'asdfasf');

