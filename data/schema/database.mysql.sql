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
  ipaddr varchar(15) NOT NULL,
  lastseen datetime default null,
  PRIMARY KEY (id),
  key `ipaddr` (`ipaddr`)
);


CREATE TABLE execution (
  id int(11) NOT NULL auto_increment ,
  nodeid int(11) not null,
  jobid int(11) not null,
  schedule varchar(100) default null,
  description varchar(255) default null,
  PRIMARY KEY (id)
);

