jobdealer
=========

Tools to manage tasks on different server.


## How to start ?

### Clone
    cd /var/www
    git clone https://github.com/changi67/jobdealer

### Initialize
    HTTPS_PROXY_REQUEST_FULLURI=false php composer.phar self-update
    HTTPS_PROXY_REQUEST_FULLURI=false php composer.phar install
    chown  HTTP_USER:HTTP_USER -R /var/www/jobdealer

### Create database and schema
    echo "
    CREATE DATABASE jobdealer;
    CREATE USER 'RW_jobdealer'@'localhost' IDENTIFIED BY 'MY_PASSWORD';
    GRANT ALL PRIVILEGES ON jobdealer.* TO 'RW_jobdealer'@'localhost';
    " | mysql -u root -p jobdealer < GIT_CLONE/data/schema/database.mysql.sql
    
### Create VHOST (exemple with Apache and FCGID)
    <VirtualHost *:80>
       ServerName jobdealer.my.domain
       Customlog "| /usr/local/bin/logger -p local3.info" combinedvhost
       ErrorLog "| /usr/local/bin/logger -t jobdealer.my.domain -p local2.info "
       DocumentRoot /var/www/jobdealer/public
    
       RewriteEngine On
       RewriteRule ^/([a-z0-9_\-]+)/?$  index.php?project=$1   [QSA,NC,L]
    
       <Location />
          AddHandler fcgid-script .php
          FCGIWrapper /usr/bin/php5-cgi .php
          Options +ExecCGI
       </Location>
    </VirtualHost>
