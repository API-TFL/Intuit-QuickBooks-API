/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`example_app_ipp_v3` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `example_app_ipp_v3`;

/*Table structure for table `quickbooks_config` */

DROP TABLE IF EXISTS `quickbooks_config`;

CREATE TABLE `quickbooks_config` (
  `quickbooks_config_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `qb_username` varchar(40) NOT NULL,
  `module` varchar(40) NOT NULL,
  `cfgkey` varchar(40) NOT NULL,
  `cfgval` varchar(40) NOT NULL,
  `cfgtype` varchar(40) NOT NULL,
  `cfgopts` text NOT NULL,
  `write_datetime` datetime NOT NULL,
  `mod_datetime` datetime NOT NULL,
  PRIMARY KEY (`quickbooks_config_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `quickbooks_config` */

/*Table structure for table `quickbooks_log` */

DROP TABLE IF EXISTS `quickbooks_log`;

CREATE TABLE `quickbooks_log` (
  `quickbooks_log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quickbooks_ticket_id` int(10) unsigned DEFAULT NULL,
  `batch` int(10) unsigned NOT NULL,
  `msg` text NOT NULL,
  `log_datetime` datetime NOT NULL,
  PRIMARY KEY (`quickbooks_log_id`),
  KEY `quickbooks_ticket_id` (`quickbooks_ticket_id`),
  KEY `batch` (`batch`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `quickbooks_log` */

/*Table structure for table `quickbooks_oauth` */

DROP TABLE IF EXISTS `quickbooks_oauth`;

CREATE TABLE `quickbooks_oauth` (
  `quickbooks_oauth_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_username` varchar(255) NOT NULL,
  `app_tenant` varchar(255) NOT NULL,
  `oauth_request_token` varchar(255) DEFAULT NULL,
  `oauth_request_token_secret` varchar(255) DEFAULT NULL,
  `oauth_access_token` varchar(255) DEFAULT NULL,
  `oauth_access_token_secret` varchar(255) DEFAULT NULL,
  `qb_realm` varchar(32) DEFAULT NULL,
  `qb_flavor` varchar(12) DEFAULT NULL,
  `qb_user` varchar(64) DEFAULT NULL,
  `request_datetime` datetime NOT NULL,
  `access_datetime` datetime DEFAULT NULL,
  `touch_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`quickbooks_oauth_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `quickbooks_oauth` */

insert  into `quickbooks_oauth`(`quickbooks_oauth_id`,`app_username`,`app_tenant`,`oauth_request_token`,`oauth_request_token_secret`,`oauth_access_token`,`oauth_access_token_secret`,`qb_realm`,`qb_flavor`,`qb_user`,`request_datetime`,`access_datetime`,`touch_datetime`) values (1,'DO_NOT_CHANGE_ME','12345','qyprdLIXzoaTTvbq7HrksbeGtFSrC18Awezw8eexyihnFhvg','UqOQOLgEXphTyTUWJAg2IBrZapwDQGXuZTebifBl','ji9Wm08HY38kBvQBD62kndxO2heztDLVOf1XSDInILt5X+IEAvhIPWG6UmjefQUAjCmqQFsbr88O2+geviW5CemTPpMY1sJkDrIV7FzzwqtsnDePX9Pyu3y7uPIxuLEECAwpXjAO1m+Yg/vVIjVxxFHsGt5Pf5gORslJiBUl76IHgm9mw02pAx2WQYtUKQ==','E7hQ/N+BWav5Y5uTkmtN7hP33FE62wSm5VA5yBsW8EH8Ias5MYiPZK5chwPWXXxOwYkX9zZN6o5ZOeJOAuOmQ5r7Aj7cPTAdPN67Z7+NG9HoSnCx/simhTTKMxT0CeHHGyf56hMOaZMgOI7dN4DhklIuGVan48QGBp2dgVRODq3j9OKynB8=','398809976','QBO',NULL,'2015-03-02 17:09:46','2015-03-02 17:10:21','2015-04-28 16:33:36');

/*Table structure for table `quickbooks_queue` */

DROP TABLE IF EXISTS `quickbooks_queue`;

CREATE TABLE `quickbooks_queue` (
  `quickbooks_queue_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quickbooks_ticket_id` int(10) unsigned DEFAULT NULL,
  `qb_username` varchar(40) NOT NULL,
  `qb_action` varchar(32) NOT NULL,
  `ident` varchar(40) NOT NULL,
  `extra` text,
  `qbxml` text,
  `priority` int(10) unsigned DEFAULT '0',
  `qb_status` char(1) NOT NULL,
  `msg` text,
  `enqueue_datetime` datetime NOT NULL,
  `dequeue_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`quickbooks_queue_id`),
  KEY `quickbooks_ticket_id` (`quickbooks_ticket_id`),
  KEY `priority` (`priority`),
  KEY `qb_username` (`qb_username`,`qb_action`,`ident`,`qb_status`),
  KEY `qb_status` (`qb_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `quickbooks_queue` */

/*Table structure for table `quickbooks_recur` */

DROP TABLE IF EXISTS `quickbooks_recur`;

CREATE TABLE `quickbooks_recur` (
  `quickbooks_recur_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `qb_username` varchar(40) NOT NULL,
  `qb_action` varchar(32) NOT NULL,
  `ident` varchar(40) NOT NULL,
  `extra` text,
  `qbxml` text,
  `priority` int(10) unsigned DEFAULT '0',
  `run_every` int(10) unsigned NOT NULL,
  `recur_lasttime` int(10) unsigned NOT NULL,
  `enqueue_datetime` datetime NOT NULL,
  PRIMARY KEY (`quickbooks_recur_id`),
  KEY `qb_username` (`qb_username`,`qb_action`,`ident`),
  KEY `priority` (`priority`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `quickbooks_recur` */

/*Table structure for table `quickbooks_ticket` */

DROP TABLE IF EXISTS `quickbooks_ticket`;

CREATE TABLE `quickbooks_ticket` (
  `quickbooks_ticket_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `qb_username` varchar(40) NOT NULL,
  `ticket` char(36) NOT NULL,
  `processed` int(10) unsigned DEFAULT '0',
  `lasterror_num` varchar(32) DEFAULT NULL,
  `lasterror_msg` varchar(255) DEFAULT NULL,
  `ipaddr` char(15) NOT NULL,
  `write_datetime` datetime NOT NULL,
  `touch_datetime` datetime NOT NULL,
  PRIMARY KEY (`quickbooks_ticket_id`),
  KEY `ticket` (`ticket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `quickbooks_ticket` */

/*Table structure for table `quickbooks_user` */

DROP TABLE IF EXISTS `quickbooks_user`;

CREATE TABLE `quickbooks_user` (
  `qb_username` varchar(40) NOT NULL,
  `qb_password` varchar(255) NOT NULL,
  `qb_company_file` varchar(255) DEFAULT NULL,
  `qbwc_wait_before_next_update` int(10) unsigned DEFAULT '0',
  `qbwc_min_run_every_n_seconds` int(10) unsigned DEFAULT '0',
  `status` char(1) NOT NULL,
  `write_datetime` datetime NOT NULL,
  `touch_datetime` datetime NOT NULL,
  PRIMARY KEY (`qb_username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `quickbooks_user` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
