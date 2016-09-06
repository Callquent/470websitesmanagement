-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 06 Septembre 2016 à 06:54
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `celebrimbor`
--

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_backoffice`
--

DROP TABLE IF EXISTS `470websitesmanagement_backoffice`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_backoffice` (
  `w_id_bo` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `w_id_info` int(11) UNSIGNED NOT NULL,
  `w_login_bo` varchar(255) NOT NULL,
  `w_password_bo` varchar(255) NOT NULL,
  PRIMARY KEY (`w_id_bo`,`w_id_info`),
  KEY `fk_id_bo` (`w_id_info`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_category`
--

DROP TABLE IF EXISTS `470websitesmanagement_category`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_category` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `c_title_url` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_database`
--

DROP TABLE IF EXISTS `470websitesmanagement_database`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_database` (
  `w_id_db` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `w_id_info` int(10) UNSIGNED NOT NULL,
  `w_host_db` varchar(255) NOT NULL,
  `w_name_db` varchar(255) NOT NULL,
  `w_login_db` varchar(255) NOT NULL,
  `w_password_db` varchar(255) NOT NULL,
  PRIMARY KEY (`w_id_db`,`w_id_info`),
  KEY `fk_id_db` (`w_id_info`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_ftp`
--

DROP TABLE IF EXISTS `470websitesmanagement_ftp`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_ftp` (
  `w_id_ftp` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `w_id_info` int(11) UNSIGNED NOT NULL,
  `w_host_ftp` varchar(255) NOT NULL,
  `w_login_ftp` varchar(255) NOT NULL,
  `w_password_ftp` varchar(255) NOT NULL,
  PRIMARY KEY (`w_id_ftp`,`w_id_info`),
  KEY `fk_id_ftp` (`w_id_info`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_info`
--

DROP TABLE IF EXISTS `470websitesmanagement_info`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_info` (
  `w_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `l_id` int(11) NOT NULL,
  `w_title` varchar(255) NOT NULL,
  `w_url_rw` varchar(255) NOT NULL,
  PRIMARY KEY (`w_id`),
  UNIQUE KEY `w_url_rw` (`w_url_rw`),
  KEY `fk_c_id` (`c_id`),
  KEY `l_id` (`l_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6002 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_language`
--

DROP TABLE IF EXISTS `470websitesmanagement_language`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_language` (
  `l_id` int(11) NOT NULL AUTO_INCREMENT,
  `l_title` varchar(255) NOT NULL,
  `l_title_url` varchar(255) NOT NULL,
  `l_color` varchar(7) NOT NULL,
  PRIMARY KEY (`l_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `470websitesmanagement_language`
--

INSERT INTO `470websitesmanagement_language` (`l_id`, `l_title`, `l_title_url`, `l_color`) VALUES
(1, 'HTML', 'html', '#E44D26'),
(2, 'Ruby on Rails', 'ruby-on-rails', '#C61704'),
(3, 'Django', 'django', '#FFE873'),
(4, 'Wordpress', 'wordpress', '#B1B1B1'),
(5, 'Prestashop', 'prestashop', '#E40B70'),
(6, 'Joomla', 'joomla', '#91BC53'),
(8, 'Drupal', 'drupal', '#00A9DF');

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_positiontracking`
--

DROP TABLE IF EXISTS `470websitesmanagement_positiontracking`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_positiontracking` (
  `w_id_pt` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `w_id_info` int(11) UNSIGNED NOT NULL,
  `keyword` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`w_id_pt`,`w_id_info`),
  KEY `fk_id_positiontracking` (`w_id_info`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_positiontracking_scheduled`
--

DROP TABLE IF EXISTS `470websitesmanagement_positiontracking_scheduled`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_positiontracking_scheduled` (
  `w_id_ptsd` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `w_id_pt` int(11) UNSIGNED NOT NULL,
  `list_website_position` text CHARACTER SET utf8 NOT NULL,
  `position` int(11) NOT NULL,
  `date_position` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`w_id_ptsd`,`w_id_pt`),
  KEY `fk_id_positiontracking_sc` (`w_id_pt`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_settings`
--

DROP TABLE IF EXISTS `470websitesmanagement_settings`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_settings` (
  `id_s` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_s` varchar(255) NOT NULL,
  `value_s` text NOT NULL,
  PRIMARY KEY (`id_s`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `470websitesmanagement_settings`
--

INSERT INTO `470websitesmanagement_settings` (`id_s`, `name_s`, `value_s`) VALUES
(1, 'lang', 'a:2:{s:4:"file";s:2:"fr";s:8:"language";s:6:"french";}');

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_whois`
--

DROP TABLE IF EXISTS `470websitesmanagement_whois`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_whois` (
  `w_id_info` int(10) UNSIGNED NOT NULL,
  `w_id_whois` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `whois` text,
  `creation_date` date DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `register` varchar(255) DEFAULT NULL,
  `release_date_whois` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`w_id_whois`,`w_id_info`),
  KEY `fk_id_whois` (`w_id_info`)
) ENGINE=InnoDB AUTO_INCREMENT=248 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aauth_groups`
--

DROP TABLE IF EXISTS `aauth_groups`;
CREATE TABLE IF NOT EXISTS `aauth_groups` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `definition` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `aauth_groups`
--

INSERT INTO `aauth_groups` (`id`, `name`, `definition`) VALUES
(1, 'Admin', 'Super Admin Group'),
(2, 'Public', 'Public Access Group'),
(3, 'Default', 'Default Access Group'),
(4, 'Developper', 'Developper Access Group'),
(5, 'Marketing', 'Marketing Access Group'),
(6, 'Visitor', 'Visitor Access Group');

-- --------------------------------------------------------

--
-- Structure de la table `aauth_perms`
--

DROP TABLE IF EXISTS `aauth_perms`;
CREATE TABLE IF NOT EXISTS `aauth_perms` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `definition` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aauth_perm_to_group`
--

DROP TABLE IF EXISTS `aauth_perm_to_group`;
CREATE TABLE IF NOT EXISTS `aauth_perm_to_group` (
  `perm_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`perm_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aauth_perm_to_user`
--

DROP TABLE IF EXISTS `aauth_perm_to_user`;
CREATE TABLE IF NOT EXISTS `aauth_perm_to_user` (
  `perm_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`perm_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aauth_pms`
--

DROP TABLE IF EXISTS `aauth_pms`;
CREATE TABLE IF NOT EXISTS `aauth_pms` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) UNSIGNED NOT NULL,
  `receiver_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `full_index` (`id`,`sender_id`,`receiver_id`,`date_read`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aauth_system_variables`
--

DROP TABLE IF EXISTS `aauth_system_variables`;
CREATE TABLE IF NOT EXISTS `aauth_system_variables` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(100) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aauth_users`
--

DROP TABLE IF EXISTS `aauth_users`;
CREATE TABLE IF NOT EXISTS `aauth_users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `banned` tinyint(1) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `last_login_attempt` datetime DEFAULT NULL,
  `forgot_exp` text,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text,
  `verification_code` text,
  `totp_secret` varchar(16) DEFAULT NULL,
  `ip_address` text,
  `login_attempts` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aauth_user_to_group`
--

DROP TABLE IF EXISTS `aauth_user_to_group`;
CREATE TABLE IF NOT EXISTS `aauth_user_to_group` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aauth_user_variables`
--

DROP TABLE IF EXISTS `aauth_user_variables`;
CREATE TABLE IF NOT EXISTS `aauth_user_variables` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `key` varchar(100) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  KEY `user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `470websitesmanagement_backoffice`
--
ALTER TABLE `470websitesmanagement_backoffice`
  ADD CONSTRAINT `fk_id_bo` FOREIGN KEY (`w_id_info`) REFERENCES `470websitesmanagement_info` (`w_id`);

--
-- Contraintes pour la table `470websitesmanagement_database`
--
ALTER TABLE `470websitesmanagement_database`
  ADD CONSTRAINT `fk_id_db` FOREIGN KEY (`w_id_info`) REFERENCES `470websitesmanagement_info` (`w_id`);

--
-- Contraintes pour la table `470websitesmanagement_ftp`
--
ALTER TABLE `470websitesmanagement_ftp`
  ADD CONSTRAINT `fk_id_ftp` FOREIGN KEY (`w_id_info`) REFERENCES `470websitesmanagement_info` (`w_id`);

--
-- Contraintes pour la table `470websitesmanagement_info`
--
ALTER TABLE `470websitesmanagement_info`
  ADD CONSTRAINT `fk_c_id` FOREIGN KEY (`c_id`) REFERENCES `470websitesmanagement_category` (`c_id`),
  ADD CONSTRAINT `fk_l_id` FOREIGN KEY (`l_id`) REFERENCES `470websitesmanagement_language` (`l_id`);

--
-- Contraintes pour la table `470websitesmanagement_positiontracking`
--
ALTER TABLE `470websitesmanagement_positiontracking`
  ADD CONSTRAINT `fk_id_positiontracking` FOREIGN KEY (`w_id_info`) REFERENCES `470websitesmanagement_info` (`w_id`);

--
-- Contraintes pour la table `470websitesmanagement_positiontracking_scheduled`
--
ALTER TABLE `470websitesmanagement_positiontracking_scheduled`
  ADD CONSTRAINT `fk_id_positiontracking_sc` FOREIGN KEY (`w_id_pt`) REFERENCES `470websitesmanagement_positiontracking` (`w_id_pt`);

--
-- Contraintes pour la table `470websitesmanagement_whois`
--
ALTER TABLE `470websitesmanagement_whois`
  ADD CONSTRAINT `fk_id_whois` FOREIGN KEY (`w_id_info`) REFERENCES `470websitesmanagement_info` (`w_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
