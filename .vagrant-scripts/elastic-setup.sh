#!/usr/bin/env bash

echo -e "\n--- Install Elastic ---\n"
sudo apt-get install -y apt-transport-https ca-certificates gnupg2

# Once all the dependencies are installed, import the GPG key with the following command:
wget -qO - https://artifacts.elastic.co/GPG-KEY-elasticsearch | apt-key add -

# Next, add the Elasticsearch repository with the following command:
sh -c 'echo "deb https://artifacts.elastic.co/packages/7.x/apt stable main" > /etc/apt/sources.list.d/elastic-7.x.list'

# Once the repository is added, you can proceed and install Elasticsearch.
# Now, update the repository cache and install the Elasticsearch with the following command:

sudo apt-get update -y
sudo apt-get install -y elasticsearch

# Once the installation is completed, start the Elasticsearch service and enable it to start at system reboot with the following command:
sudo systemctl start elasticsearch
sudo systemctl enable elasticsearch

# Next, verify whether Elasticsearch is running or not with the following command:
curl -X GET "localhost:9200"