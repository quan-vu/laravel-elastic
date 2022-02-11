#!/usr/bin/env bash

PASSWORD='vagrant'
PROJECT_HOSTNAME="$1"

echo -e "\n--- Update system ---\n"
sudo apt-get update

echo -e "\n--- Install PHP 8.0 ---\n"
sudo apt-get install -y software-properties-common language-pack-en-base
sudo LC_ALL=en_US.UTF-8 add-apt-repository ppa:ondrej/php
sudo apt-get update

sudo apt install -y php8.0 php8.0-common php8.0-fpm \
    php8.0-mbstring php8.0-xmlrpc php8.0-soap php8.0-gd \
    php8.0-xml php8.0-intl php8.0-mysql php8.0-cli php8.0-mcrypt \
    php8.0-zip php8.0-curl


echo -e "\n--- Disable default apache2 service on ubuntu 20 ---\n"
sudo systemctl stop apache2.service
sudo update-rc.d apache2 disable
sudo systemctl status apache2.service

echo -e "\n--- Install nginx ---\n"
sudo apt-get -y install nginx

# Create virtual host
sudo cp /vagrant/.vagrant-scripts/nginx/laravel.template.conf /etc/nginx/sites-available/default
sudo sed -i "s/{{DOMAIN}}/$PROJECT_HOSTNAME/g" /etc/nginx/sites-available/default
sudo nginx -t

# Create index.php
sudo touch /vagrant/www/public/index.php
echo "<?php phpinfo(); ?>" > /vagrant/www/public/index.php

# Restart nginx
sudo service nginx restart
sudo service nginx status

echo -e "\n--- Install GIT ---\n"
sudo apt-get -y install git

echo -e "\n--- Install Composer ---\n"
curl -s https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer




