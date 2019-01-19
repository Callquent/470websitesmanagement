-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 15 sep. 2018 à 07:28
-- Version du serveur :  5.7.19
-- Version de PHP :  7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `name_category` varchar(255) CHARACTER SET latin1 NOT NULL,
  `name_url_category` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

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
-- Structure de la table `470websitesmanagement_groups`
--

DROP TABLE IF EXISTS `470websitesmanagement_groups`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_groups` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `definition` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `470websitesmanagement_groups`
--

INSERT INTO `470websitesmanagement_groups` (`id`, `name`, `definition`) VALUES
(1, 'Admin', 'Super Admin Group'),
(2, 'Public', 'Public Access Group'),
(3, 'Unknown', 'Unknown Access Group'),
(4, 'Developper', 'Developper Access Group'),
(5, 'Marketing', 'Marketing Access Group');

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_group_to_group`
--

DROP TABLE IF EXISTS `470websitesmanagement_group_to_group`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_group_to_group` (
  `group_id` int(11) UNSIGNED NOT NULL,
  `subgroup_id` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`group_id`,`subgroup_id`)
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
  `id_language` int(11) NOT NULL AUTO_INCREMENT,
  `name_language` varchar(255) NOT NULL,
  `name_url_language` varchar(255) NOT NULL,
  PRIMARY KEY (`id_language`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `470websitesmanagement_language`
--

INSERT INTO `470websitesmanagement_language` (`id_language`, `name_language`, `name_url_language`) VALUES
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
-- Structure de la table `470websitesmanagement_login_attempts`
--

DROP TABLE IF EXISTS `470websitesmanagement_login_attempts`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(39) DEFAULT '0',
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_perms`
--

DROP TABLE IF EXISTS `470websitesmanagement_perms`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_perms` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `definition` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_perm_to_group`
--

DROP TABLE IF EXISTS `470websitesmanagement_perm_to_group`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_perm_to_group` (
  `perm_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`perm_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_perm_to_user`
--

DROP TABLE IF EXISTS `470websitesmanagement_perm_to_user`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_perm_to_user` (
  `perm_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`perm_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_pms`
--

DROP TABLE IF EXISTS `470websitesmanagement_pms`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_pms` (
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
-- Déchargement des données de la table `470websitesmanagement_settings`
--

INSERT INTO `470websitesmanagement_settings` (`id_s`, `name_s`, `value_s`) VALUES
(1, 'lang', 'a:2:{s:4:\"file\";s:2:\"fr\";s:8:\"language\";s:6:\"french\";}');

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_tasks`
--

DROP TABLE IF EXISTS `470websitesmanagement_tasks`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_tasks` (
  `id_project_tasks` int(11) UNSIGNED NOT NULL,
  `id_card_tasks` int(11) UNSIGNED NOT NULL,
  `id_task` int(11) UNSIGNED NOT NULL,
  `name_task` varchar(255) NOT NULL,
  `check_tasks` tinyint(1) NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_project_tasks`,`id_task`,`id_card_tasks`),
  KEY `id_users` (`id_user`),
  KEY `fk_task_to_list_tasks` (`id_card_tasks`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_tasks__card`
--

DROP TABLE IF EXISTS `470websitesmanagement_tasks__card`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_tasks__card` (
  `id_project_tasks` int(11) UNSIGNED NOT NULL,
  `id_card_tasks` int(11) UNSIGNED NOT NULL,
  `title_card_tasks` varchar(255) NOT NULL,
  `description_card_tasks` text NOT NULL,
  `id_priority_tasks` int(11) NOT NULL,
  `id_status_tasks` int(11) NOT NULL,
  PRIMARY KEY (`id_card_tasks`,`id_project_tasks`),
  KEY `fk_id_list_tasks` (`id_project_tasks`),
  KEY `fk_id_status_tasks` (`id_status_tasks`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_tasks__priority`
--

DROP TABLE IF EXISTS `470websitesmanagement_tasks__priority`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_tasks__priority` (
  `id_tasks_priority` int(11) NOT NULL AUTO_INCREMENT,
  `name_tasks_priority` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tasks_priority`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `470websitesmanagement_tasks__priority`
--

INSERT INTO `470websitesmanagement_tasks__priority` (`id_tasks_priority`, `name_tasks_priority`) VALUES
(1, 'Low'),
(2, 'Medium'),
(3, 'Hight'),
(4, 'Critical');

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_tasks__project`
--

DROP TABLE IF EXISTS `470websitesmanagement_tasks__project`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_tasks__project` (
  `id_project_tasks` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_website` int(11) UNSIGNED NOT NULL,
  `name_project_tasks` varchar(255) NOT NULL,
  `started_project_tasks` date NOT NULL,
  `deadline_project_tasks` date NOT NULL,
  PRIMARY KEY (`id_project_tasks`),
  KEY `fk_id_pt` (`id_website`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_tasks__status`
--

DROP TABLE IF EXISTS `470websitesmanagement_tasks__status`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_tasks__status` (
  `id_tasks_status` int(11) NOT NULL AUTO_INCREMENT,
  `name_tasks_status` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tasks_status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `470websitesmanagement_tasks__status`
--

INSERT INTO `470websitesmanagement_tasks__status` (`id_tasks_status`, `name_tasks_status`) VALUES
(1, 'To Do'),
(2, 'In Progress'),
(3, 'Completed');

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_users`
--

DROP TABLE IF EXISTS `470websitesmanagement_users`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_users` (
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
) ENGINE=InnoDB AUTO_INCREMENT=546 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_user_to_group`
--

DROP TABLE IF EXISTS `470websitesmanagement_user_to_group`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_user_to_group` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_user_variables`
--

DROP TABLE IF EXISTS `470websitesmanagement_user_variables`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_user_variables` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  KEY `user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_website`
--

DROP TABLE IF EXISTS `470websitesmanagement_website`;
CREATE TABLE IF NOT EXISTS `470websitesmanagement_website` (
  `id_website` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NOT NULL,
  `id_language` int(11) NOT NULL,
  `name_website` varchar(255) NOT NULL,
  `url_website` varchar(255) NOT NULL,
  PRIMARY KEY (`id_website`),
  UNIQUE KEY `w_url_rw` (`url_website`),
  KEY `fk_c_id` (`id_category`),
  KEY `fk_l_id` (`id_language`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `470websitesmanagement_backoffice`
--
ALTER TABLE `470websitesmanagement_backoffice`
  ADD CONSTRAINT `fk_id_bo` FOREIGN KEY (`id_website`) REFERENCES `470websitesmanagement_website` (`id_website`);

--
-- Contraintes pour la table `470websitesmanagement_database`
--
ALTER TABLE `470websitesmanagement_database`
  ADD CONSTRAINT `fk_id_db` FOREIGN KEY (`id_website`) REFERENCES `470websitesmanagement_website` (`id_website`);

--
-- Contraintes pour la table `470websitesmanagement_ftp`
--
ALTER TABLE `470websitesmanagement_ftp`
  ADD CONSTRAINT `fk_id_ftp` FOREIGN KEY (`id_website`) REFERENCES `470websitesmanagement_website` (`id_website`);

--
-- Contraintes pour la table `470websitesmanagement_htaccess`
--
ALTER TABLE `470websitesmanagement_htaccess`
  ADD CONSTRAINT `fk_id_ht` FOREIGN KEY (`id_website`) REFERENCES `470websitesmanagement_website` (`id_website`);

--
-- Contraintes pour la table `470websitesmanagement_positiontracking`
--
ALTER TABLE `470websitesmanagement_positiontracking`
  ADD CONSTRAINT `fk_id_positiontracking` FOREIGN KEY (`w_id_info`) REFERENCES `470websitesmanagement_website` (`id_website`);

--
-- Contraintes pour la table `470websitesmanagement_positiontracking_scheduled`
--
ALTER TABLE `470websitesmanagement_positiontracking_scheduled`
  ADD CONSTRAINT `fk_id_positiontracking_sc` FOREIGN KEY (`w_id_pt`) REFERENCES `470websitesmanagement_positiontracking` (`w_id_pt`);

--
-- Contraintes pour la table `470websitesmanagement_tasks`
--
ALTER TABLE `470websitesmanagement_tasks`
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `470websitesmanagement_users` (`id`),
  ADD CONSTRAINT `fk_task_to_card_tasks` FOREIGN KEY (`id_card_tasks`) REFERENCES `470websitesmanagement_tasks__card` (`id_card_tasks`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_task_to_project_tasks` FOREIGN KEY (`id_project_tasks`) REFERENCES `470websitesmanagement_tasks__project` (`id_project_tasks`);

--
-- Contraintes pour la table `470websitesmanagement_tasks__card`
--
ALTER TABLE `470websitesmanagement_tasks__card`
  ADD CONSTRAINT `fk_id_card_tasks` FOREIGN KEY (`id_project_tasks`) REFERENCES `470websitesmanagement_tasks__project` (`id_project_tasks`),
  ADD CONSTRAINT `fk_id_status_tasks` FOREIGN KEY (`id_status_tasks`) REFERENCES `470websitesmanagement_tasks__status` (`id_tasks_status`);

--
-- Contraintes pour la table `470websitesmanagement_tasks__project`
--
ALTER TABLE `470websitesmanagement_tasks__project`
  ADD CONSTRAINT `fk_id_pt` FOREIGN KEY (`id_website`) REFERENCES `470websitesmanagement_website` (`id_website`);

--
-- Contraintes pour la table `470websitesmanagement_website`
--
ALTER TABLE `470websitesmanagement_website`
  ADD CONSTRAINT `fk_c_id` FOREIGN KEY (`id_category`) REFERENCES `470websitesmanagement_category` (`id_category`),
  ADD CONSTRAINT `fk_l_id` FOREIGN KEY (`id_language`) REFERENCES `470websitesmanagement_language` (`id_language`);

--
-- Contraintes pour la table `470websitesmanagement_whois`
--
ALTER TABLE `470websitesmanagement_whois`
  ADD CONSTRAINT `fk_whois_id` FOREIGN KEY (`whois_id`) REFERENCES `470websitesmanagement_website` (`id_website`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
