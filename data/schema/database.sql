drop database jobdealer;

create database jobdealer;

use jobdealer;


CREATE TABLE job (
  id int(11) NOT NULL auto_increment,
  description varchar(255) default null,
  action varchar(500) NOT NULL,
  defaultschedule varchar(100) NOT NULL,
  estimatedduration time NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE node (
  id int(11) NOT NULL auto_increment,
  nodename varchar(255) default null,
  description varchar(255) default null,
  ipaddr int(10) unsigned NOT NULL,
  lastseen datetime default null,
  PRIMARY KEY (id),
  key `ipaddr` (`ipaddr`)
);
