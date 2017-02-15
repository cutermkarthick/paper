 CREATE TABLE `patient_surgery` (
  `recnum` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create_date` date DEFAULT NULL,
  `action_taken` text,
  `modified_date` date DEFAULT NULL,
  `surgery_date` date,
  `surgeon_contact_no` varchar(25),
  `surgery_location` varchar(100),
  `surgeon_name` varchar(100),
  `surgery_name` varchar(100),
  `location_contact_no` varchar(50) DEFAULT NULL,
  `link2patient` int(10),
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 ;

 CREATE TABLE `surgery_notes` (
   `recnum` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `link2patient` int(10) unsigned DEFAULT NULL,
  `link2user` varchar(50) DEFAULT NULL,
  `surgery_notes` longtext,
   PRIMARY KEY (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1  ;


CREATE TABLE `patient_postop` (
  `recnum` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) DEFAULT NULL,
  `notes` longtext,
  `cur_date` date DEFAULT NULL,
  `link2patient` int(10),
  `to_do` longtext,
  `postop_day1` longtext,
  `postop_day2` longtext,
  `modified_date` date DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1  ;

CREATE TABLE `patient_postop_notes` (
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `link2patient` int(10) unsigned DEFAULT NULL,
  `link2user` varchar(50) DEFAULT NULL,
  `postop_notes` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;


CREATE TABLE `patient_postop_comm_notes` (
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `link2patient` int(10) unsigned DEFAULT NULL,
  `link2user` varchar(50) DEFAULT NULL,
  `postop_comm_notes` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;

