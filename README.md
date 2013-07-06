jobdealer
=========

Tools to manage tasks on different server.


## How to start ?

### Clone
    cd /var/www
    git clone https://github.com/jobdealer/jobdealer

### Initialize without proxy
    php composer.phar install
    chown  HTTP_USER:HTTP_USER -R /var/www/jobdealer

### Initialize behind proxy
    HTTPS_PROXY_REQUEST_FULLURI=false php composer.phar self-update
    HTTPS_PROXY_REQUEST_FULLURI=false php composer.phar install
    chown  HTTP_USER:HTTP_USER -R /var/www/jobdealer

### Create database and schema (example with MySQL)
    echo "
    CREATE DATABASE jobdealer;
    CREATE USER 'RW_jobdealer'@'localhost' IDENTIFIED BY 'MY_PASSWORD';
    GRANT ALL PRIVILEGES ON jobdealer.* TO 'RW_jobdealer'@'localhost';
    " | mysql -u root -p
    
    mysql -u root -p jobdealer < /var/www/jobdealer/data/schema/database.mysql.sql

### Configure your serveur type (mysql or sqlite), address and db name :
    cp /var/www/jobdealer/config/autoload/local.php.dist config/autoload/local.php
    vi /var/www/jobdealer/config/autoload/local.php

### Configure user and password DB in (only for MySQL):
    vi /var/www/jobdealer/config/autoload/global.php

### Create VHOST (example with Apache and FCGID)
    <VirtualHost *:80>
       ServerName jobdealer.my.domain
       Customlog "| /usr/local/bin/logger -p local3.info" combinedvhost
       ErrorLog "| /usr/local/bin/logger -t jobdealer.my.domain -p local2.info "
       DocumentRoot /var/www/jobdealer/public
    
       <Location />
          AddHandler fcgid-script .php
          FCGIWrapper /usr/bin/php5-cgi .php
          Options +ExecCGI
       </Location>
    </VirtualHost>
    
### Create VHOST (example with Nginx and php5-fpm)
    server {
       listen   80; ## listen for ipv4; this line is default and implied
    
       root /yourdocumentrooth/public/;
       index index.html index.php;
       server_name myjobdealer.local;
    
       location / {
          index index.php;
       }
    
       if (!-e $request_filename) {
          rewrite ^.*$ /index.php last;
       }
    
       location ~ \.php$ {
          fastcgi_split_path_info ^(.+\.php)(/.+)$;
          # NOTE: You should have "cgi.fix_pathinfo = 0;" in php.ini
    
          # With php5-cgi alone:
          #fastcgi_pass 127.0.0.1:9001;
          # With php5-fpm:
          fastcgi_pass unix:/var/run/web.sock;
          fastcgi_index index.php;
          include fastcgi_params;
       }
    
       # deny access to .htaccess files, if Apache's document root
       # concurs with nginx's one
       location ~ /\.ht {
          deny all;
       }
    }
