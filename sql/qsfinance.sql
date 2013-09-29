CREATE TABLE `qs_dev_db`.`acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=68;

CREATE TABLE `qs_dev_db`.`aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7;

CREATE TABLE `qs_dev_db`.`aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12;


CREATE TABLE `qs_dev_db`.`boekingstukkens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `boekingstuk` varchar(30) NOT NULL,
  `omschrijving` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7;

CREATE TABLE `qs_dev_db`.`bookyears` (
  `id` varchar(36) NOT NULL,
  `prevyear` varchar(36) DEFAULT NULL COMMENT 'Het voorgaande boekjaar',
  `startdatum` date NOT NULL,
  `einddatum` date NOT NULL,
  `omschrijving` varchar(50) NOT NULL,
  `closed` tinyint(1) NOT NULL COMMENT 'boekjaar gesloten (1=gesloten, 0=open->bewerkingen mogelijk)',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE `qs_dev_db`.`calculations` (
  `id` varchar(36) NOT NULL,
  `grootboek_id` varchar(36) NOT NULL,
  `bookyear_id` varchar(36) NOT NULL,
  `boekingstuk` varchar(40) DEFAULT NULL,
  `omschrijving` varchar(100) NOT NULL,
  `boekdatum` date NOT NULL,
  `debet` decimal(10,2) DEFAULT NULL,
  `credit` decimal(10,2) DEFAULT NULL,
  `beginbalans` tinyint(1) NOT NULL COMMENT 'Beginbalans, altijd ''0'' behalve bij het aanmaken van en nieuwboekjaar. De initiele ''Van Balans'' mutatie =1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;


CREATE TABLE `qs_dev_db`.`grootboeks` (
  `id` varchar(36) NOT NULL,
  `nummer` varchar(4) NOT NULL,
  `omschrijving` varchar(100) NOT NULL,
  `debetcredit` varchar(7) NOT NULL,
  `winstverlies` tinyint(1) NOT NULL COMMENT 'Winstverlies (1) of Balanspost  (0)',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `liquide` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nummer` (`nummer`)
) ENGINE=MyISAM;

CREATE TABLE `qs_dev_db`.`groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4;


CREATE TABLE `qs_dev_db`.`schemas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nummer` char(4) NOT NULL,
  `omschrijving` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 COMMENT='Het grootboek schema (het patern)';

CREATE TABLE `qs_dev_db`.`users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` char(40) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=4;

CREATE TABLE `qs_dev_db`.`bankaccounts` (
  `id` int(11) NOT NULL,
  `maatschappij` varchar(45) NOT NULL,
  `iban` varchar(45) NOT NULL,
  `rekeningnummer` varchar(45) NOT NULL,
  `grootboek_id` varchar(36) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

INSERT INTO `qs_dev_db`.`users`
(`id`,
`username`,
`password`,
`group_id`,
`created`,
`modified`)
VALUES
(
'1',
'administrator',
'02845b966c2a766b28d7566d9020dd154346bf1f',
'1',
'2011-09-19 16:27:30',
'2011-09-19 20:52:20'
);
