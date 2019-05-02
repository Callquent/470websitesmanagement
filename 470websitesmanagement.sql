-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  lun. 15 avr. 2019 à 18:43
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.20

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
-- Structure de la table `470websitesmanagement_category`
--

CREATE TABLE `470websitesmanagement_category` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(255) CHARACTER SET latin1 NOT NULL,
  `name_url_category` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_groups`
--

CREATE TABLE `470websitesmanagement_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `470websitesmanagement_group_to_group` (
  `group_id` int(11) UNSIGNED NOT NULL,
  `subgroup_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_language`
--

CREATE TABLE `470websitesmanagement_language` (
  `id_language` int(11) NOT NULL,
  `name_language` varchar(255) NOT NULL,
  `name_url_language` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(7, 'Drupal', 'drupal'),
(8, 'OpenCart', 'opencart');

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_login_attempts`
--

CREATE TABLE `470websitesmanagement_login_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(39) DEFAULT '0',
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_perms`
--

CREATE TABLE `470websitesmanagement_perms` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `470websitesmanagement_perms`
--

INSERT INTO `470websitesmanagement_perms` (`id`, `name`, `definition`) VALUES
(1, 'create_user', NULL),
(2, 'edit_user', NULL),
(3, 'delete_user', NULL),
(4, 'page_user', NULL),
(5, 'create_language', NULL),
(6, 'edit_language', NULL),
(7, 'delete_language', NULL),
(8, 'page_language', NULL),
(9, 'create_category', NULL),
(10, 'edit_category', NULL),
(11, 'delete_category', NULL),
(12, 'page_category', NULL),
(13, 'page_export', NULL),
(14, 'page_import', NULL),
(15, 'page_settings', NULL),
(16, 'create_website', NULL),
(17, 'update_website', NULL),
(18, 'delete_website', NULL),
(19, 'create_access_ftp', NULL),
(20, 'update_access_ftp', NULL),
(21, 'delete_access_ftp', NULL),
(22, 'create_access_database', NULL),
(23, 'update_access_database', NULL),
(24, 'delete_access_database', NULL),
(25, 'create_access_backoffice', NULL),
(26, 'update_access_backoffice', NULL),
(27, 'delete_access_backoffice', NULL),
(28, 'update_access_htaccess', NULL),
(29, 'delete_access_htaccess', NULL),
(30, 'create_access_htaccess', NULL),
(31, 'sendmail_website', NULL),
(32, 'page_website', NULL),
(33, 'page_ftp_website', NULL),
(34, 'page_whois_domain', NULL),
(35, 'page_search_scrapper_google', NULL),
(36, 'page_website_scrapper_google', NULL),
(37, 'create_group_members', NULL),
(38, 'update_group_members', NULL),
(39, 'delete_group_members', NULL),
(40, 'page_group_members', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_perm_to_group`
--

CREATE TABLE `470websitesmanagement_perm_to_group` (
  `perm_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_perm_to_user`
--

CREATE TABLE `470websitesmanagement_perm_to_user` (
  `perm_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_pms`
--

CREATE TABLE `470websitesmanagement_pms` (
  `id` int(11) UNSIGNED NOT NULL,
  `sender_id` int(11) UNSIGNED NOT NULL,
  `receiver_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL,
  `pm_deleted_sender` int(1) DEFAULT NULL,
  `pm_deleted_receiver` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_positiontracking`
--

CREATE TABLE `470websitesmanagement_positiontracking` (
  `w_id_pt` int(11) UNSIGNED NOT NULL,
  `w_id_info` int(11) UNSIGNED NOT NULL,
  `keyword` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_positiontracking_scheduled`
--

CREATE TABLE `470websitesmanagement_positiontracking_scheduled` (
  `w_id_ptsd` int(11) UNSIGNED NOT NULL,
  `w_id_pt` int(11) UNSIGNED NOT NULL,
  `list_website_position` text CHARACTER SET utf8 NOT NULL,
  `position` int(11) NOT NULL,
  `date_position` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_settings`
--

CREATE TABLE `470websitesmanagement_settings` (
  `id_s` int(11) UNSIGNED NOT NULL,
  `name_s` varchar(255) NOT NULL,
  `value_s` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `470websitesmanagement_settings`
--

INSERT INTO `470websitesmanagement_settings` (`id_s`, `name_s`, `value_s`) VALUES
(1, 'lang', 'a:2:{s:4:\"file\";s:2:\"fr\";s:8:\"language\";s:6:\"french\";}');

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_tasks`
--

CREATE TABLE `470websitesmanagement_tasks` (
  `id_project_tasks` int(11) UNSIGNED NOT NULL,
  `id_card_tasks` int(11) UNSIGNED NOT NULL,
  `id_task` int(11) UNSIGNED NOT NULL,
  `name_task` varchar(255) NOT NULL,
  `check_tasks` tinyint(1) NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_tasks__card`
--

CREATE TABLE `470websitesmanagement_tasks__card` (
  `id_project_tasks` int(11) UNSIGNED NOT NULL,
  `id_card_tasks` int(11) UNSIGNED NOT NULL,
  `name_card_tasks` varchar(255) NOT NULL,
  `description_card_tasks` text NOT NULL,
  `id_tasks_priority` int(11) NOT NULL,
  `id_tasks_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_tasks__priority`
--

CREATE TABLE `470websitesmanagement_tasks__priority` (
  `id_tasks_priority` int(11) NOT NULL,
  `name_tasks_priority` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `470websitesmanagement_tasks__project` (
  `id_project_tasks` int(11) UNSIGNED NOT NULL,
  `id_website` int(11) UNSIGNED NOT NULL,
  `name_project_tasks` varchar(255) NOT NULL,
  `started_project_tasks` date NOT NULL,
  `deadline_project_tasks` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_tasks__status`
--

CREATE TABLE `470websitesmanagement_tasks__status` (
  `id_tasks_status` int(11) NOT NULL,
  `name_tasks_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `470websitesmanagement_tasks__status`
--

INSERT INTO `470websitesmanagement_tasks__status` (`id_tasks_status`, `name_tasks_status`) VALUES
(1, 'to do'),
(2, 'in progress'),
(3, 'completed');

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_users`
--

CREATE TABLE `470websitesmanagement_users` (
  `id` int(11) UNSIGNED NOT NULL,
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
  `ip_address` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_user_to_group`
--

CREATE TABLE `470websitesmanagement_user_to_group` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_user_variables`
--

CREATE TABLE `470websitesmanagement_user_variables` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_website`
--

CREATE TABLE `470websitesmanagement_website` (
  `id_website` int(11) UNSIGNED NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_language` int(11) NOT NULL,
  `name_website` varchar(255) NOT NULL,
  `url_website` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_website__backoffice`
--

CREATE TABLE `470websitesmanagement_website__backoffice` (
  `id_backoffice` int(11) UNSIGNED NOT NULL,
  `id_website` int(11) UNSIGNED NOT NULL,
  `host_backoffice` varchar(255) NOT NULL,
  `login_backoffice` varchar(255) NOT NULL,
  `password_backoffice` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_website__database`
--

CREATE TABLE `470websitesmanagement_website__database` (
  `id_database` int(11) UNSIGNED NOT NULL,
  `id_website` int(10) UNSIGNED NOT NULL,
  `host_database` varchar(255) NOT NULL,
  `name_database` varchar(255) NOT NULL,
  `login_database` varchar(255) NOT NULL,
  `password_database` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_website__ftp`
--

CREATE TABLE `470websitesmanagement_website__ftp` (
  `id_ftp` int(11) UNSIGNED NOT NULL,
  `id_website` int(11) UNSIGNED NOT NULL,
  `host_ftp` varchar(255) NOT NULL,
  `login_ftp` varchar(255) NOT NULL,
  `password_ftp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_website__htaccess`
--

CREATE TABLE `470websitesmanagement_website__htaccess` (
  `id_htaccess` int(10) UNSIGNED NOT NULL,
  `id_website` int(10) UNSIGNED NOT NULL,
  `login_htaccess` varchar(255) NOT NULL,
  `password_htaccess` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `470websitesmanagement_whois`
--

CREATE TABLE `470websitesmanagement_whois` (
  `id_whois` int(11) UNSIGNED NOT NULL,
  `whois` text,
  `creation_date` date DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `registrar` varchar(255) DEFAULT NULL,
  `release_date_whois` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `470websitesmanagement_category`
--
ALTER TABLE `470websitesmanagement_category`
  ADD PRIMARY KEY (`id_category`),
  ADD UNIQUE KEY `name_category` (`name_category`);

--
-- Index pour la table `470websitesmanagement_groups`
--
ALTER TABLE `470websitesmanagement_groups`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `470websitesmanagement_group_to_group`
--
ALTER TABLE `470websitesmanagement_group_to_group`
  ADD PRIMARY KEY (`group_id`,`subgroup_id`);

--
-- Index pour la table `470websitesmanagement_language`
--
ALTER TABLE `470websitesmanagement_language`
  ADD PRIMARY KEY (`id_language`),
  ADD UNIQUE KEY `name_language` (`name_language`);

--
-- Index pour la table `470websitesmanagement_login_attempts`
--
ALTER TABLE `470websitesmanagement_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `470websitesmanagement_perms`
--
ALTER TABLE `470websitesmanagement_perms`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `470websitesmanagement_perm_to_group`
--
ALTER TABLE `470websitesmanagement_perm_to_group`
  ADD PRIMARY KEY (`perm_id`,`group_id`);

--
-- Index pour la table `470websitesmanagement_perm_to_user`
--
ALTER TABLE `470websitesmanagement_perm_to_user`
  ADD PRIMARY KEY (`perm_id`,`user_id`);

--
-- Index pour la table `470websitesmanagement_pms`
--
ALTER TABLE `470websitesmanagement_pms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `full_index` (`id`,`sender_id`,`receiver_id`,`date_read`);

--
-- Index pour la table `470websitesmanagement_positiontracking`
--
ALTER TABLE `470websitesmanagement_positiontracking`
  ADD PRIMARY KEY (`w_id_pt`,`w_id_info`),
  ADD KEY `fk_id_positiontracking` (`w_id_info`);

--
-- Index pour la table `470websitesmanagement_positiontracking_scheduled`
--
ALTER TABLE `470websitesmanagement_positiontracking_scheduled`
  ADD PRIMARY KEY (`w_id_ptsd`,`w_id_pt`),
  ADD KEY `fk_id_positiontracking_sc` (`w_id_pt`);

--
-- Index pour la table `470websitesmanagement_settings`
--
ALTER TABLE `470websitesmanagement_settings`
  ADD PRIMARY KEY (`id_s`);

--
-- Index pour la table `470websitesmanagement_tasks`
--
ALTER TABLE `470websitesmanagement_tasks`
  ADD PRIMARY KEY (`id_project_tasks`,`id_task`,`id_card_tasks`),
  ADD KEY `id_users` (`id_user`),
  ADD KEY `fk_task_to_list_tasks` (`id_card_tasks`);

--
-- Index pour la table `470websitesmanagement_tasks__card`
--
ALTER TABLE `470websitesmanagement_tasks__card`
  ADD PRIMARY KEY (`id_card_tasks`,`id_project_tasks`),
  ADD KEY `fk_id_list_tasks` (`id_project_tasks`),
  ADD KEY `fk_id_status_tasks` (`id_tasks_status`),
  ADD KEY `fk_id_priority_tasks` (`id_tasks_priority`);

--
-- Index pour la table `470websitesmanagement_tasks__priority`
--
ALTER TABLE `470websitesmanagement_tasks__priority`
  ADD PRIMARY KEY (`id_tasks_priority`);

--
-- Index pour la table `470websitesmanagement_tasks__project`
--
ALTER TABLE `470websitesmanagement_tasks__project`
  ADD PRIMARY KEY (`id_project_tasks`),
  ADD KEY `fk_id_pt` (`id_website`);

--
-- Index pour la table `470websitesmanagement_tasks__status`
--
ALTER TABLE `470websitesmanagement_tasks__status`
  ADD PRIMARY KEY (`id_tasks_status`);

--
-- Index pour la table `470websitesmanagement_users`
--
ALTER TABLE `470websitesmanagement_users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `470websitesmanagement_user_to_group`
--
ALTER TABLE `470websitesmanagement_user_to_group`
  ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- Index pour la table `470websitesmanagement_user_variables`
--
ALTER TABLE `470websitesmanagement_user_variables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_index` (`user_id`);

--
-- Index pour la table `470websitesmanagement_website`
--
ALTER TABLE `470websitesmanagement_website`
  ADD PRIMARY KEY (`id_website`),
  ADD UNIQUE KEY `w_url_rw` (`url_website`),
  ADD KEY `fk_c_id` (`id_category`),
  ADD KEY `fk_l_id` (`id_language`) USING BTREE;

--
-- Index pour la table `470websitesmanagement_website__backoffice`
--
ALTER TABLE `470websitesmanagement_website__backoffice`
  ADD PRIMARY KEY (`id_backoffice`,`id_website`),
  ADD KEY `fk_id_bo` (`id_website`);

--
-- Index pour la table `470websitesmanagement_website__database`
--
ALTER TABLE `470websitesmanagement_website__database`
  ADD PRIMARY KEY (`id_database`,`id_website`),
  ADD KEY `fk_id_db` (`id_website`);

--
-- Index pour la table `470websitesmanagement_website__ftp`
--
ALTER TABLE `470websitesmanagement_website__ftp`
  ADD PRIMARY KEY (`id_ftp`,`id_website`),
  ADD KEY `fk_id_ftp` (`id_website`);

--
-- Index pour la table `470websitesmanagement_website__htaccess`
--
ALTER TABLE `470websitesmanagement_website__htaccess`
  ADD PRIMARY KEY (`id_htaccess`,`id_website`),
  ADD KEY `fk_id_ht` (`id_website`);

--
-- Index pour la table `470websitesmanagement_whois`
--
ALTER TABLE `470websitesmanagement_whois`
  ADD PRIMARY KEY (`id_whois`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `470websitesmanagement_category`
--
ALTER TABLE `470websitesmanagement_category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `470websitesmanagement_groups`
--
ALTER TABLE `470websitesmanagement_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `470websitesmanagement_language`
--
ALTER TABLE `470websitesmanagement_language`
  MODIFY `id_language` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `470websitesmanagement_login_attempts`
--
ALTER TABLE `470websitesmanagement_login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `470websitesmanagement_perms`
--
ALTER TABLE `470websitesmanagement_perms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `470websitesmanagement_pms`
--
ALTER TABLE `470websitesmanagement_pms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `470websitesmanagement_positiontracking`
--
ALTER TABLE `470websitesmanagement_positiontracking`
  MODIFY `w_id_pt` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `470websitesmanagement_positiontracking_scheduled`
--
ALTER TABLE `470websitesmanagement_positiontracking_scheduled`
  MODIFY `w_id_ptsd` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `470websitesmanagement_settings`
--
ALTER TABLE `470websitesmanagement_settings`
  MODIFY `id_s` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `470websitesmanagement_tasks__priority`
--
ALTER TABLE `470websitesmanagement_tasks__priority`
  MODIFY `id_tasks_priority` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `470websitesmanagement_tasks__project`
--
ALTER TABLE `470websitesmanagement_tasks__project`
  MODIFY `id_project_tasks` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `470websitesmanagement_tasks__status`
--
ALTER TABLE `470websitesmanagement_tasks__status`
  MODIFY `id_tasks_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `470websitesmanagement_users`
--
ALTER TABLE `470websitesmanagement_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `470websitesmanagement_user_variables`
--
ALTER TABLE `470websitesmanagement_user_variables`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `470websitesmanagement_website`
--
ALTER TABLE `470websitesmanagement_website`
  MODIFY `id_website` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `470websitesmanagement_website__backoffice`
--
ALTER TABLE `470websitesmanagement_website__backoffice`
  MODIFY `id_backoffice` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `470websitesmanagement_website__database`
--
ALTER TABLE `470websitesmanagement_website__database`
  MODIFY `id_database` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `470websitesmanagement_website__ftp`
--
ALTER TABLE `470websitesmanagement_website__ftp`
  MODIFY `id_ftp` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `470websitesmanagement_website__htaccess`
--
ALTER TABLE `470websitesmanagement_website__htaccess`
  MODIFY `id_htaccess` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `470websitesmanagement_whois`
--
ALTER TABLE `470websitesmanagement_whois`
  MODIFY `id_whois` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

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
  ADD CONSTRAINT `fk_id_priority_tasks` FOREIGN KEY (`id_tasks_priority`) REFERENCES `470websitesmanagement_tasks__priority` (`id_tasks_priority`),
  ADD CONSTRAINT `fk_id_status_tasks` FOREIGN KEY (`id_tasks_status`) REFERENCES `470websitesmanagement_tasks__status` (`id_tasks_status`);

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
-- Contraintes pour la table `470websitesmanagement_website__backoffice`
--
ALTER TABLE `470websitesmanagement_website__backoffice`
  ADD CONSTRAINT `fk_id_bo` FOREIGN KEY (`id_website`) REFERENCES `470websitesmanagement_website` (`id_website`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `470websitesmanagement_website__database`
--
ALTER TABLE `470websitesmanagement_website__database`
  ADD CONSTRAINT `fk_id_db` FOREIGN KEY (`id_website`) REFERENCES `470websitesmanagement_website` (`id_website`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `470websitesmanagement_website__ftp`
--
ALTER TABLE `470websitesmanagement_website__ftp`
  ADD CONSTRAINT `fk_id_ftp` FOREIGN KEY (`id_website`) REFERENCES `470websitesmanagement_website` (`id_website`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `470websitesmanagement_website__htaccess`
--
ALTER TABLE `470websitesmanagement_website__htaccess`
  ADD CONSTRAINT `fk_id_ht` FOREIGN KEY (`id_website`) REFERENCES `470websitesmanagement_website` (`id_website`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `470websitesmanagement_whois`
--
ALTER TABLE `470websitesmanagement_whois`
  ADD CONSTRAINT `fk_whois_id` FOREIGN KEY (`id_whois`) REFERENCES `470websitesmanagement_website` (`id_website`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
