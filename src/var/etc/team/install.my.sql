/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE TABLE IF NOT EXISTS `team` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_index` int(10) unsigned DEFAULT NULL,
  `online` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `team_ci_team_member` (
  `id` int(11) NOT NULL,
  `team_member_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `team_ci_team_member_index_1` (`team_member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `team_controller_page_config` (
  `id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `team_controller_page_config_teams` (
  `team_controller_page_config_id` int(10) unsigned NOT NULL,
  `team_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`team_controller_page_config_id`,`team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `team_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `file_image` varchar(255) DEFAULT NULL,
  `order_index` int(10) unsigned DEFAULT NULL,
  `online` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `team_member_page_controller` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `team_member_page_controller_team_members` (
  `team_member_page_controller_id` int(10) unsigned NOT NULL,
  `team_member_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`team_member_page_controller_id`,`team_member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `team_member_t` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `n2n_locale` varchar(12) DEFAULT NULL,
  `team_member_id` int(10) unsigned DEFAULT NULL,
  `function` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `team_member_t_index_1` (`team_member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `team_member_teams` (
  `team_member_id` int(10) unsigned NOT NULL,
  `team_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`team_member_id`,`team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `team_page_controller` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `team_page_controller_teams` (
  `team_page_controller_id` int(10) unsigned NOT NULL,
  `team_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`team_page_controller_id`,`team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `team_t` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `n2n_locale` varchar(12) DEFAULT NULL,
  `team_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `team_t_index_1` (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
