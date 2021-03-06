/*
SQL da versão de desenvolvimento 0.1 do EveCMS
Desenvolvido para MySQL - em breve será portado para PostgreSQL
*/

DROP DATABASE IF EXISTS `eve`;
CREATE DATABASE `eve` DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

USE `eve`;

DROP TABLE IF EXISTS `administradores`;
CREATE TABLE `administradores` (
  `nome` varchar(64) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `login` varchar(20) COLLATE utf8_bin NOT NULL,
  `senha` varchar(255) COLLATE utf8_bin NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT 'Status 0 significa que a conta está inativa',
  `permissoes` text COLLATE utf8_bin NOT NULL COMMENT 'JSON Encoded',
  `avatar` varchar(40) COLLATE utf8_bin DEFAULT 'sem_avatar.png',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `title` varchar(64) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `body` text COLLATE utf8_bin NOT NULL,
  `slug` varchar(255) COLLATE utf8_bin NOT NULL,
  `datetime` datetime NOT NULL,
  `last_update` datetime DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
