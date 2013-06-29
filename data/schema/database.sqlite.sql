DROP TABLE job;

CREATE TABLE job (
  id integer PRIMARY KEY NOT NULL,
  description text default null,
  action text NOT NULL,
  defaultschedule text NOT NULL,
  estimatedduration numeric NOT NULL
);

DROP TABLE node;
CREATE TABLE node (
  id integer PRIMARY KEY NOT NULL,
  nodename text default null,
  description text default null,
  ipaddr char(15) NOT NULL,
  lastseen numeric default null
);

CREATE INDEX file_hash_list_ipaddr on node (ipaddr);

DROP TABLE execution;
CREATE TABLE execution (
  id integer PRIMARY KEY NOT NULL,
  nodeid int not null,
  jobid int not null,
  schedule char(15) NOT NULL,
  description text default null
);
