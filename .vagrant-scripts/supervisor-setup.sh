#!/usr/bin/env bash

sudo apt-get install -y supervisor
sudo cp /vagrant/.vagrant-scripts/supervisor/* /etc/supervisor/conf.d
sudo service supervisor restart