#!/usr/bin/env bash

PASSWORD='vagrant'
PROJECT_HOSTNAME="$1"

echo -e "\n--- Update system ---\n"
sudo apt-get update

echo -e "\n--- Install Apache ---\n"
sudo apt-get install -y apache2

echo -e "\n--- Install PHP 8.0 ---\n"
sudo apt-get install -y software-properties-common
sudo apt-get install -y language-pack-en-base
sudo LC_ALL=en_US.UTF-8 add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt install -y php8.0 libapache2-mod-php8.0 php8.0-common php8.0-mbstring php8.0-xmlrpc php8.0-soap php8.0-gd php8.0-xml php8.0-intl php8.0-mysql php8.0-cli php8.0-mcrypt php8.0-zip php8.0-curl

echo -e "\n--- Create Virtual Host ---\n"
VHOST=$(cat <<EOF
<VirtualHost *:80>
    ServerName ${PROJECT_HOSTNAME}
    ServerAlias www.${PROJECT_HOSTNAME}

    DocumentRoot /var/www/html
    <Directory /var/www>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

<VirtualHost *:443>
    ServerName ${PROJECT_HOSTNAME}
    ServerAlias www.${PROJECT_HOSTNAME}

    SSLEngine on
    SSLCertificateFile /vagrant/.ssl/cert.pem
    SSLCertificateKeyFile /vagrant/.ssl/key.pem

    DocumentRoot /var/www/html
    <Directory /var/www>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
EOF
)
echo "${VHOST}" > /etc/apache2/sites-available/000-default.conf

echo -e "\n--- Create index.php ---\n"
sudo rm /var/www/html/index.html
sudo touch /var/www/html/index.php
echo "<?php phpinfo(); ?>" > /var/www/html/index.php

echo -e "\n--- Enable mod_rewrite ---\n"
sudo a2enmod rewrite

echo -e "\n--- Enable ssl ---\n"
sudo a2enmod ssl

echo -e "\n--- Restart Apache ---\n"
sudo service apache2 restart

echo -e "\n--- Install GIT ---\n"
sudo apt-get -y install git

echo -e "\n--- Install Composer ---\n"
curl -s https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer




