INSERT INTO job (description,action,defaultschedule, estimatedduration)
    VALUES  ('ls',  'ls', '*/14 * * *', '02:00');
INSERT INTO job (description,action,defaultschedule, estimatedduration)
    VALUES  ('cp',  'cp', '*/30 * * *', '00:01');
INSERT INTO job (description,action,defaultschedule, estimatedduration)
    VALUES  ('dir',  'dir', '*/14 * * *', '02:00');
INSERT INTO job (description,action,defaultschedule, estimatedduration)
    VALUES  ('cpuinfo',  'cat /proc/cpuinfo', '*/14 * * *', '02:00');

INSERT INTO node (nodename, ipaddr, description, lastseen)
    VALUES ('node1', '192.168.0.1', 'node 1', datetime('now'));
INSERT INTO node (nodename, ipaddr, description, lastseen)
    VALUES ('node2', '192.168.0.2', 'node 2', datetime('now'));
INSERT INTO node (nodename, ipaddr, description, lastseen)
  VALUES ('node3', '192.168.0.3', 'node 3', datetime('now'));
INSERT INTO node (nodename, ipaddr, description, lastseen)
  VALUES ('node4', '192.168.0.4', 'node 4', datetime('now'));