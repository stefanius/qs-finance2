CREATE TABLE `qs_dev_db`.`acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE `qs_dev_db`.`aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

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
) ENGINE=MyISAM;


CREATE TABLE `qs_dev_db`.`boekingstukkens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `boekingstuk` varchar(30) NOT NULL,
  `omschrijving` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

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
  `hash` varchar(36) DEFAULT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  `omschrijving` varchar(100) NOT NULL,
  `boekdatum` date NOT NULL,
  `debet` decimal(10,2) DEFAULT NULL,
  `credit` decimal(10,2) DEFAULT NULL,
  `beginbalans` tinyint(1) NOT NULL COMMENT 'Beginbalans, altijd ''0'' behalve bij het aanmaken van en nieuwboekjaar. De initiele ''Van Balans'' mutatie =1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE `qs_dev_db`.`organisations` (
  `id` varchar(36) NOT NULL,
  `name` varchar(255) NOT NULL,
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
  `email` varchar(255) NOT NULL,
  `password` char(40) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4;

CREATE TABLE `qs_dev_db`.`bankaccounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `maatschappij` varchar(45) NOT NULL,
  `iban` varchar(45) NOT NULL,
  `rekeningnummer` varchar(45) NOT NULL,
  `grootboek_id` varchar(36) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

insert into `qs_dev_db`.`groups` values
	(3,'Viewers','2011-09-19 16:26:45','2011-09-19 16:26:45'),
	(2,'Users','2011-09-19 16:24:39','2011-09-19 16:24:58'),
	(1,'Administrators','2011-09-19 16:23:09','2011-09-19 16:23:09')
;

insert into `qs_dev_db`.`aros` values
	(6,3,'User',3,NULL,10,11),
	(5,2,'User',2,NULL,6,7),
	(4,1,'User',1,NULL,2,3),
	(3,NULL,'Group',3,NULL,9,12),
	(2,NULL,'Group',2,NULL,5,8),
	(1,NULL,'Group',1,NULL,1,4)
;

INSERT INTO `qs_dev_db`.`users`
(`id`,`username`,`email`,`password`,`group_id`,`created`,`modified`)
VALUES
(1,'administrator','administrator@qs.nl','02845b966c2a766b28d7566d9020dd154346bf1f','1','2011-09-19 16:27:30','2011-09-19 20:52:20'),
(3,'viewer'       ,'viewer@qs.nl','b2793813ad59793da1b1a82ed35e6059ed61717d',3,'2011-09-19 16:28:07','2011-09-19 20:52:46'),
(2,'user'         ,'user@qs.nl','8099237577b8b49103e41dfa2cef298f105e3ce8',2,'2011-09-19 16:27:47','2011-09-19 20:52:34')
;


INSERT INTO `qs_dev_db`.`grootboeks` (`id`,`nummer`,`omschrijving`,`debetcredit`,`winstverlies`,`created`,`modified`,`liquide`) 
VALUES ('1e611700-131c-4b7b-85d0-14649d87f14d','0700','Voorraad','debet',0,'2011-09-02 17:48:48','2011-09-02 17:48:48',0);

INSERT INTO `qs_dev_db`.`grootboeks` (`id`,`nummer`,`omschrijving`,`debetcredit`,`winstverlies`,`created`,`modified`,`liquide`) 
VALUES ('1e4c01e3-47f8-457c-8e3d-17209d87f14d','0110','Bank - Lopende Rekening (rabo)','debet',0,'2011-08-17 18:01:07','2013-09-11 20:08:36',1);

INSERT INTO `qs_dev_db`.`grootboeks` (`id`,`nummer`,`omschrijving`,`debetcredit`,`winstverlies`,`created`,`modified`,`liquide`) 
VALUES ('1e581ea5-6934-493c-bf38-14649d87f14d','0111','Bank - Lopende rekening (ing)','debet',0,'2011-08-26 22:31:01','2011-09-26 17:46:57',0);

INSERT INTO `qs_dev_db`.`grootboeks` (`id`,`nummer`,`omschrijving`,`debetcredit`,`winstverlies`,`created`,`modified`,`liquide`) 
VALUES ('1e581f04-7efc-48ce-8d4b-14649d87f14d','0112','Bank - Spaarrekening','debet',0,'2011-08-26 22:32:36','2012-11-19 19:58:12',0);

INSERT INTO `qs_dev_db`.`grootboeks` (`id`,`nummer`,`omschrijving`,`debetcredit`,`winstverlies`,`created`,`modified`,`liquide`) 
VALUES ('1e4c018b-7288-49bd-ae3a-17209d87f14d','0076','Lening','credit',0,'2011-08-17 17:59:39','2011-08-17 17:59:39',0);

INSERT INTO `qs_dev_db`.`grootboeks` (`id`,`nummer`,`omschrijving`,`debetcredit`,`winstverlies`,`created`,`modified`,`liquide`) 
VALUES ('1e4c01b3-0ff8-4272-a5a1-17209d87f14d','0100','Kas','debet',0,'2011-08-17 18:00:19','2011-08-17 18:00:19',0);

INSERT INTO `qs_dev_db`.`grootboeks` (`id`,`nummer`,`omschrijving`,`debetcredit`,`winstverlies`,`created`,`modified`,`liquide`) 
VALUES ('1e4c01f2-6934-46db-891c-17209d87f14d','0130','debiteuren','debet',0,'2011-08-17 18:01:22','2011-08-17 18:01:22',0);

INSERT INTO `qs_dev_db`.`grootboeks` (`id`,`nummer`,`omschrijving`,`debetcredit`,`winstverlies`,`created`,`modified`,`liquide`) 
VALUES ('1e4c0266-7e44-4c36-b40d-17209d87f14d','0140','Crediteuren','credit',0,'2011-08-17 18:03:18','2011-08-17 18:03:18',0);

INSERT INTO `qs_dev_db`.`grootboeks` (`id`,`nummer`,`omschrijving`,`debetcredit`,`winstverlies`,`created`,`modified`,`liquide`) 
VALUES ('1e581e4e-e3f8-4601-9810-14649d87f14d','9999','Kruispost: Voorschotten','credit',1,'2011-08-26 22:29:34','2011-08-26 22:29:34',0);

INSERT INTO `qs_dev_db`.`grootboeks` (`id`,`nummer`,`omschrijving`,`debetcredit`,`winstverlies`,`created`,`modified`,`liquide`) 
VALUES ('1e4ed10d-da5c-40d7-9cad-17209d87f14d','0420','Huisvestingskosten','credit',1,'2011-08-19 21:09:33','2011-08-19 21:09:33',0);

INSERT INTO `qs_dev_db`.`grootboeks` (`id`,`nummer`,`omschrijving`,`debetcredit`,`winstverlies`,`created`,`modified`,`liquide`) 
VALUES ('1e4ed172-9294-44c0-9373-17209d87f14d','0800','Inkoopwaarde verkopen','credit',1,'2011-08-19 21:11:14','2011-08-19 21:22:22',0);

INSERT INTO `qs_dev_db`.`grootboeks` (`id`,`nummer`,`omschrijving`,`debetcredit`,`winstverlies`,`created`,`modified`,`liquide`) 
VALUES ('1e4ed1c1-7338-480e-a396-17209d87f14d','0840','Opbrengst Verkopen','credit',1,'2011-08-19 21:12:33','2011-08-19 21:22:50',0);

INSERT INTO `qs_dev_db`.`grootboeks` (`id`,`nummer`,`omschrijving`,`debetcredit`,`winstverlies`,`created`,`modified`,`liquide`) 
VALUES ('1e4ed1d3-56ec-406c-8b17-17209d87f14d','0910','Kasverschillen','credit',1,'2011-08-19 21:12:51','2011-08-19 21:22:38',0);

INSERT INTO `qs_dev_db`.`grootboeks` (`id`,`nummer`,`omschrijving`,`debetcredit`,`winstverlies`,`created`,`modified`,`liquide`) 
VALUES ('1e4ed1e9-504c-4212-9798-17209d87f14d','0920','Voorraad Verschillen','credit',1,'2011-08-19 21:13:13','2011-08-19 21:13:13',0);

INSERT INTO `qs_dev_db`.`grootboeks` (`id`,`nummer`,`omschrijving`,`debetcredit`,`winstverlies`,`created`,`modified`,`liquide`) 
VALUES ('1e4ed219-e974-4aba-a431-17209d87f14d','0950','Incidentele resultaten','credit',1,'2011-08-19 21:14:01','2011-08-19 21:14:01',0);

INSERT INTO `qs_dev_db`.`grootboeks` (`id`,`nummer`,`omschrijving`,`debetcredit`,`winstverlies`,`created`,`modified`,`liquide`) 
VALUES ('1e80bc3f-fb18-4eab-9bf3-15189d87f14d','0424','Rekeningkosten','credit',1,'2011-09-26 17:54:07','2011-09-26 17:54:07',0);

INSERT INTO `qs_dev_db`.`grootboeks` (`id`,`nummer`,`omschrijving`,`debetcredit`,`winstverlies`,`created`,`modified`,`liquide`) 
VALUES ('1e80bc76-b5a4-408c-b016-15189d87f14d','0425','Interestkosten','credit',1,'2011-09-26 17:55:02','2011-09-26 17:55:02',0);

