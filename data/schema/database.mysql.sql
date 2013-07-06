ALTER DATABASE DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS `job`;
CREATE TABLE job (
  id int(11) NOT NULL auto_increment,
  description varchar(255) default null,
  action varchar(500) NOT NULL,
  defaultschedule varchar(100) NOT NULL,
  estimatedduration time NOT NULL,
  PRIMARY KEY (id)
);

DROP TABLE IF EXISTS `node`;
CREATE TABLE node (
  id int(11) NOT NULL auto_increment,
  nodename varchar(255) default null,
  description varchar(255) default null,
  ipaddr varchar(15) NOT NULL,
  lastseen datetime default null,
  PRIMARY KEY (id),
  key `ipaddr` (`ipaddr`)
);

DROP TABLE IF EXISTS `execution`;
CREATE TABLE execution (
  id int(11) NOT NULL auto_increment ,
  nodeid int(11) not null,
  jobid int(11) not null,
  schedule varchar(100) default null,
  description varchar(255) default null,
  PRIMARY KEY (id)
);
