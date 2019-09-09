-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caption` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tags` (`id`, `caption`, `created`) VALUES
(1,	'Tag 1',	'2019-08-13 09:26:22'),
(2,	'Tag 2',	'2019-08-13 09:26:50'),
(3,	'Tag 3',	'2019-08-13 09:27:17'),
(4,	'Tag 4',	'2019-08-13 15:33:36'),
(5,	'Tag 5',	'2019-08-15 10:42:29');

DROP TABLE IF EXISTS `tags_tasks`;
CREATE TABLE `tags_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tag_id` (`tag_id`),
  KEY `task_id` (`task_id`),
  CONSTRAINT `tags_tasks_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tags_tasks_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tags_tasks` (`id`, `tag_id`, `task_id`) VALUES
(1,	2,	1),
(2,	3,	1),
(3,	1,	2),
(5,	1,	4),
(6,	2,	4),
(7,	3,	4),
(8,	2,	7),
(9,	4,	2);

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `priority` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tasks` (`id`, `uuid`, `caption`, `status`, `priority`, `created`, `modified`) VALUES
(1,	'c2f8af27-d8d2-4366-b4f7-b6290f21f516',	'Lorem ipsum dolor sit amet',	0,	2,	'2019-08-13 09:24:59',	'2019-08-13 09:37:07'),
(2,	'3f8ae26a-24b4-4e3e-a2b5-693cf26b2673',	'consectetur adipiscing elit',	1,	0,	'2019-08-13 11:06:26',	'2019-08-15 10:51:05'),
(3,	'5aef8b9e-524f-46c2-b416-e19bb6e9b240',	'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',	1,	0,	'2019-08-13 14:41:13',	'2019-08-13 14:41:13'),
(4,	'd4edcba9-ee5a-4aed-ae45-d2e157bd5be7',	'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat',	1,	1,	'2019-08-13 14:46:23',	'2019-08-13 14:46:23'),
(5,	'8950d7e6-b35c-4d24-9612-688670a99e40',	'Duis aute irure dolor ',	0,	2,	'2019-08-13 14:47:58',	'2019-08-13 14:47:58'),
(6,	'bb9d36ad-1988-41a6-879e-37f9c3f094f5',	'Excepteur sint occaecat cupidatat non proident',	0,	2,	'2019-08-13 15:57:01',	'2019-08-13 15:57:01'),
(7,	'a83d8ff4-756f-4e85-a027-142111ca00e0',	'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium',	1,	0,	'2019-08-13 15:59:20',	'2019-08-13 15:59:20');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `name`, `login`, `password`, `created`) VALUES
(1,	'Administrator',	'admin',	'$2y$10$M.0OYzPMGQxNOygjv8.ZCu4i3gVzWH8pK40vmsijsyGNWUI/iuTMy',	'2019-08-14 16:14:50'),
(3,	'User Name',	'user',	'$2y$10$Cj4pvpmd6RUH33dLddi80uRgSNdy2czesAGvOQamnWmp4hjC56xmO',	'2019-08-14 17:48:55');

-- 2019-08-15 16:25:20
