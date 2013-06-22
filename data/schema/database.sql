drop database jobdealer;

create database jobdealer;

use jobdealer;


CREATE TABLE job (
  id int(11) NOT NULL auto_increment,
  description varchar(255) default null,
  action varchar(500) NOT NULL,
  schedule varchar(100) NOT NULL,
  estimatedduration time NOT NULL,
  PRIMARY KEY (id)
);

INSERT INTO job (description,action,schedule, estimatedduration)
    VALUES  ('ls',  'ls', '*/14 * * *', '02:00');
INSERT INTO job (description,action,schedule, estimatedduration)
    VALUES  ('cp',  'cp', '*/30 * * *', '00:01');
INSERT INTO job (description,action,schedule, estimatedduration)
    VALUES  ('dir',  'dir', '*/14 * * *', '02:00');
INSERT INTO job (description,action,schedule, estimatedduration)
    VALUES  ('cpuinfo',  'cat /proc/cpuinfo', '*/14 * * *', '02:00');
