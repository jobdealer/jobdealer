INSERT INTO job (description,action,defaultschedule, estimatedduration)
    VALUES  ('List directory content',  'ls', '*/14 * * *', '02:00');
INSERT INTO job (description,action,defaultschedule, estimatedduration)
    VALUES  ('Copy file',  'cp', '*/30 * * *', '00:01');
INSERT INTO job (description,action,defaultschedule, estimatedduration)
    VALUES  ('Move file',  'mv', '*/14 * * *', '02:00');
INSERT INTO job (description,action,defaultschedule, estimatedduration)
    VALUES  ('View CPU info',  'cat /proc/cpuinfo', '*/14 * * *', '02:00');

INSERT INTO node (nodename, ipaddr, description, lastseen)
    VALUES ('node1', '192.168.0.1', 'node 1', datetime('now'));
INSERT INTO node (nodename, ipaddr, description, lastseen)
    VALUES ('node2', '192.168.0.2', 'node 2', datetime('now'));
INSERT INTO node (nodename, ipaddr, description, lastseen)
  VALUES ('node3', '192.168.0.3', 'node 3', datetime('now'));
INSERT INTO node (nodename, ipaddr, description, lastseen)
  VALUES ('node4', '192.168.0.4', 'node 4', datetime('now'));

INSERT INTO execution (nodeid, jobid, schedule, description)
  VALUES ('1', '2', '*/15 * * * *',  'node1 job1');
INSERT INTO execution (nodeid, jobid, schedule, description)
  VALUES ('2', '2', '*/15 * * * *',  'node2 job2');
INSERT INTO execution (nodeid, jobid, schedule, description)
  VALUES ('1', '3', '*/15 * * * *', 'node1 job3');
INSERT INTO execution (nodeid, jobid, schedule, description)
  VALUES ('1', '4', '*/15 * * * *', 'node1 job4');
