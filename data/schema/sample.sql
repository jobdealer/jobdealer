use jobdealer;

INSERT INTO job (description,action,defaultschedule, estimatedduration)
    VALUES  ('ls',  'ls', '*/14 * * *', '02:00');
INSERT INTO job (description,action,defaultschedule, estimatedduration)
    VALUES  ('cp',  'cp', '*/30 * * *', '00:01');
INSERT INTO job (description,action,defaultschedule, estimatedduration)
    VALUES  ('dir',  'dir', '*/14 * * *', '02:00');
INSERT INTO job (description,action,defaultschedule, estimatedduration)
    VALUES  ('cpuinfo',  'cat /proc/cpuinfo', '*/14 * * *', '02:00');

INSERT INTO node (nodename, ipaddr, description, lastseen)
    VALUES ('node1', INET_ATON('192.168.0.1'), 'node 1', now());
INSERT INTO node (nodename, ipaddr, description, lastseen)
    VALUES ('node2', INET_ATON('192.168.0.2'), 'node 2', now());
INSERT INTO node (nodename, ipaddr, description, lastseen)
  VALUES ('node3', INET_ATON('192.168.0.3'), 'node 3', now());
INSERT INTO node (nodename, ipaddr, description, lastseen)
  VALUES ('node4', INET_ATON('192.168.0.4'), 'node 4', now());