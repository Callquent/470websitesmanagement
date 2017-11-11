-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 29 Octobre 2017 à 06:42
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
  `id_backoffice` int(11) UNSIGNED NOT NULL,
  `id_website` int(11) UNSIGNED NOT NULL,
  `host_backoffice` varchar(255) NOT NULL,
  `login_backoffice` varchar(255) NOT NULL,
  `password_backoffice` varchar(255) NOT NULL,
  PRIMARY KEY (`id_backoffice`,`id_website`),
  KEY `fk_id_bo` (`id_website`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_database`
--

DROP TABLE IF EXISTS `470websitesmanagement_database`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_database` (
  `id_database` int(11) UNSIGNED NOT NULL,
  `id_website` int(10) UNSIGNED NOT NULL,
  `host_database` varchar(255) NOT NULL,
  `name_database` varchar(255) NOT NULL,
  `login_database` varchar(255) NOT NULL,
  `password_database` varchar(255) NOT NULL,
  PRIMARY KEY (`id_database`,`id_website`),
  KEY `fk_id_db` (`id_website`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_ftp`
--

DROP TABLE IF EXISTS `470websitesmanagement_ftp`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_ftp` (
  `id_ftp` int(11) UNSIGNED NOT NULL,
  `id_website` int(11) UNSIGNED NOT NULL,
  `host_ftp` varchar(255) NOT NULL,
  `login_ftp` varchar(255) NOT NULL,
  `password_ftp` varchar(255) NOT NULL,
  PRIMARY KEY (`id_ftp`,`id_website`),
  KEY `fk_id_ftp` (`id_website`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_htaccess`
--

DROP TABLE IF EXISTS `470websitesmanagement_htaccess`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_htaccess` (
  `id_htaccess` int(10) UNSIGNED NOT NULL,
  `id_website` int(10) UNSIGNED NOT NULL,
  `login_htaccess` varchar(255) NOT NULL,
  `password_htaccess` varchar(255) NOT NULL,
  PRIMARY KEY (`id_htaccess`,`id_website`),
  KEY `fk_id_ht` (`id_website`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_language`
--

DROP TABLE IF EXISTS `470websitesmanagement_language`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_language` (
  `l_id` int(11) NOT NULL AUTO_INCREMENT,
  `l_title` varchar(255) NOT NULL,
  `l_title_url` varchar(255) NOT NULL,
  PRIMARY KEY (`l_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `470websitesmanagement_language`
--

INSERT INTO `470websitesmanagement_language` (`l_id`, `l_title`, `l_title_url`) VALUES
(1, 'HTML', 'html'),
(2, 'Ruby on Rails', 'ruby-on-rails'),
(3, 'Django', 'django'),
(4, 'Wordpress', 'wordpress'),
(5, 'Prestashop', 'prestashop'),
(6, 'Joomla', 'joomla'),
(8, 'Drupal', 'drupal'),
(9, 'OpenCart', 'opencart');

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_list_tasks`
--

DROP TABLE IF EXISTS `470websitesmanagement_list_tasks`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_list_tasks` (
  `id_list_tasks` int(11) UNSIGNED NOT NULL,
  `id_project_tasks` int(11) UNSIGNED NOT NULL,
  `title_list_task` varchar(255) NOT NULL,
  PRIMARY KEY (`id_list_tasks`,`id_project_tasks`),
  KEY `fk_id_list_taskss` (`id_project_tasks`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Structure de la table `470websitesmanagement_project_tasks`
--

DROP TABLE IF EXISTS `470websitesmanagement_project_tasks`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_project_tasks` (
  `id_project_tasks` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_website` int(11) UNSIGNED NOT NULL,
  `title_project_tasks` varchar(255) NOT NULL,
  `started_project_tasks` date NOT NULL,
  `deadline_project_tasks` date NOT NULL,
  PRIMARY KEY (`id_project_tasks`),
  KEY `fk_id_pt` (`id_website`)
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
-- Structure de la table `470websitesmanagement_tasks`
--

DROP TABLE IF EXISTS `470websitesmanagement_tasks`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_tasks` (
  `id_project_tasks` int(11) UNSIGNED NOT NULL,
  `id_task` int(11) UNSIGNED NOT NULL,
  `id_list_tasks` int(11) UNSIGNED NOT NULL,
  `name_task` varchar(255) NOT NULL,
  `description_task` varchar(255) NOT NULL,
  `id_task_priority` int(11) NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_project_tasks`,`id_task`,`id_list_tasks`),
  KEY `fk_id_list_tasks` (`id_list_tasks`),
  KEY `id_tasks_priority` (`id_task_priority`),
  KEY `id_users` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_tasks_priority`
--

DROP TABLE IF EXISTS `470websitesmanagement_tasks_priority`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_tasks_priority` (
  `id_tasks_priority` int(11) NOT NULL,
  `name_tasks_priority` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tasks_priority`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_website`
--

DROP TABLE IF EXISTS `470websitesmanagement_website`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_website` (
  `w_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `l_id` int(11) NOT NULL,
  `name_website` varchar(255) NOT NULL,
  `url_website` varchar(255) NOT NULL,
  PRIMARY KEY (`w_id`),
  UNIQUE KEY `w_url_rw` (`url_website`),
  KEY `fk_c_id` (`c_id`),
  KEY `fk_l_id` (`l_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_whois`
--

DROP TABLE IF EXISTS `470websitesmanagement_whois`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_whois` (
  `whois_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `whois` text,
  `creation_date` date DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `registrar` varchar(255) DEFAULT NULL,
  `release_date_whois` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`whois_id`)
) ENGINE=InnoDB AUTO_INCREMENT=335 DEFAULT CHARSET=utf8;

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
(3, 'Unknown', 'Unknown Access Group'),
(4, 'Developper', 'Developper Access Group'),
(5, 'Marketing', 'Marketing Access Group'),
(6, 'Visitor', 'Visitor Access Group');

-- --------------------------------------------------------

--
-- Structure de la table `aauth_group_to_group`
--

DROP TABLE IF EXISTS `aauth_group_to_group`;
CREATE TABLE IF NOT EXISTS `aauth_group_to_group` (
  `group_id` int(11) UNSIGNED NOT NULL,
  `subgroup_id` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`group_id`,`subgroup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aauth_login_attempts`
--

DROP TABLE IF EXISTS `aauth_login_attempts`;
CREATE TABLE IF NOT EXISTS `aauth_login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(39) DEFAULT '0',
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

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
  `perm_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`perm_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aauth_perm_to_user`
--

DROP TABLE IF EXISTS `aauth_perm_to_user`;
CREATE TABLE IF NOT EXISTS `aauth_perm_to_user` (
  `perm_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
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
  `pm_deleted_sender` int(1) DEFAULT NULL,
  `pm_deleted_receiver` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `full_index` (`id`,`sender_id`,`receiver_id`,`date_read`)
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
  `username` varchar(100) DEFAULT NULL,
  `banned` tinyint(1) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `forgot_exp` text,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text,
  `verification_code` text,
  `totp_secret` varchar(16) DEFAULT NULL,
  `ip_address` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aauth_user_to_group`
--

DROP TABLE IF EXISTS `aauth_user_to_group`;
CREATE TABLE IF NOT EXISTS `aauth_user_to_group` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL,
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
  `data_key` varchar(100) NOT NULL,
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
  ADD CONSTRAINT `fk_id_bo` FOREIGN KEY (`id_website`) REFERENCES `470websitesmanagement_website` (`w_id`);

--
-- Contraintes pour la table `470websitesmanagement_database`
--
ALTER TABLE `470websitesmanagement_database`
  ADD CONSTRAINT `fk_id_db` FOREIGN KEY (`id_website`) REFERENCES `470websitesmanagement_website` (`w_id`);

--
-- Contraintes pour la table `470websitesmanagement_ftp`
--
ALTER TABLE `470websitesmanagement_ftp`
  ADD CONSTRAINT `fk_id_ftp` FOREIGN KEY (`id_website`) REFERENCES `470websitesmanagement_website` (`w_id`);

--
-- Contraintes pour la table `470websitesmanagement_htaccess`
--
ALTER TABLE `470websitesmanagement_htaccess`
  ADD CONSTRAINT `fk_id_ht` FOREIGN KEY (`id_website`) REFERENCES `470websitesmanagement_website` (`w_id`);

--
-- Contraintes pour la table `470websitesmanagement_list_tasks`
--
ALTER TABLE `470websitesmanagement_list_tasks`
  ADD CONSTRAINT `fk_id_list_taskss` FOREIGN KEY (`id_project_tasks`) REFERENCES `470websitesmanagement_project_tasks` (`id_project_tasks`);

--
-- Contraintes pour la table `470websitesmanagement_positiontracking`
--
ALTER TABLE `470websitesmanagement_positiontracking`
  ADD CONSTRAINT `fk_id_positiontracking` FOREIGN KEY (`w_id_info`) REFERENCES `470websitesmanagement_website` (`w_id`);

--
-- Contraintes pour la table `470websitesmanagement_positiontracking_scheduled`
--
ALTER TABLE `470websitesmanagement_positiontracking_scheduled`
  ADD CONSTRAINT `fk_id_positiontracking_sc` FOREIGN KEY (`w_id_pt`) REFERENCES `470websitesmanagement_positiontracking` (`w_id_pt`);

--
-- Contraintes pour la table `470websitesmanagement_project_tasks`
--
ALTER TABLE `470websitesmanagement_project_tasks`
  ADD CONSTRAINT `fk_id_pt` FOREIGN KEY (`id_website`) REFERENCES `470websitesmanagement_website` (`w_id`);

--
-- Contraintes pour la table `470websitesmanagement_tasks`
--
ALTER TABLE `470websitesmanagement_tasks`
  ADD CONSTRAINT `fk_id_list_tasks` FOREIGN KEY (`id_list_tasks`) REFERENCES `470websitesmanagement_list_tasks` (`id_list_tasks`),
  ADD CONSTRAINT `fk_id_project_tasks` FOREIGN KEY (`id_project_tasks`) REFERENCES `470websitesmanagement_list_tasks` (`id_project_tasks`),
  ADD CONSTRAINT `fk_id_task_priority` FOREIGN KEY (`id_task_priority`) REFERENCES `470websitesmanagement_tasks_priority` (`id_tasks_priority`),
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `aauth_users` (`id`);

--
-- Contraintes pour la table `470websitesmanagement_website`
--
ALTER TABLE `470websitesmanagement_website`
  ADD CONSTRAINT `fk_c_id` FOREIGN KEY (`c_id`) REFERENCES `470websitesmanagement_category` (`c_id`),
  ADD CONSTRAINT `fk_l_id` FOREIGN KEY (`l_id`) REFERENCES `470websitesmanagement_language` (`l_id`);

--
-- Contraintes pour la table `470websitesmanagement_whois`
--
ALTER TABLE `470websitesmanagement_whois`
  ADD CONSTRAINT `fk_whois_id` FOREIGN KEY (`whois_id`) REFERENCES `470websitesmanagement_website` (`w_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
