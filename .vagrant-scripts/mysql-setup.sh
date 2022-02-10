#!/usr/bin/env bash

MYSQL_DB_NAME="main"
MYSQL_DB_NAME_TEST="test"
MYSQL_USER_ROOT="root"
MYSQL_PASSWORD_ROOT="root"

echo -e "\n--- Install MySQL ---\n"
sudo apt-get -y update
sudo apt-get -y install mysql-server
sudo mysql -u root -e "ALTER USER '${MYSQL_USER_ROOT}'@'localhost' IDENTIFIED WITH mysql_native_password BY '${MYSQL_PASSWORD_ROOT}';"
mysql -h localhost -u${MYSQL_USER_ROOT} -p${MYSQL_PASSWORD_ROOT} -e "CREATE DATABASE IF NOT EXISTS \`${MYSQL_DB_NAME}\` CHARACTER SET utf8 COLLATE utf8_general_ci"
mysql -h localhost -u${MYSQL_USER_ROOT} -p${MYSQL_PASSWORD_ROOT} -e "CREATE DATABASE IF NOT EXISTS \`${MYSQL_DB_NAME_TEST}\` CHARACTER SET utf8 COLLATE utf8_general_ci"
sudo service mysql restart