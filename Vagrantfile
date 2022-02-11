# -*- mode: ruby -*-
# vi: set ft=ruby :

# Setup project info
# Use current dir name as domain
PROJECT_NAME = File.basename(File.dirname(__FILE__))
PROJECT_HOSTNAME = "#{PROJECT_NAME}.local"
PROJECT_HOSTNAME_ALIAS = "www.#{PROJECT_NAME}.local"

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
  # You can search for boxes at https://vagrantcloud.com/search.
  config.vm.box = "ubuntu/focal64"

  # `vagrant box outdated`. Disable automatic box update checking. This is not recommended.
  # config.vm.box_check_update = false

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  # NOTE: This will enable public access to the opened port
  # config.vm.network "forwarded_port", guest: 80, host: 8080

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine and only allow access
  # via 127.0.0.1 to disable public access
  # config.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"

  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
  # config.vm.network "private_network", ip: "192.168.33.10"

  # Create a public network, which generally matched to bridged network.
  # Bridged networks make the machine appear as another physical device on
  # your network.
  # config.vm.network "public_network"

  # Share an additional folder to the guest VM. The first argument is
  # the path on the host to the actual folder. The second argument is
  # the path on the guest to mount the folder. And the optional third
  # argument is a set of non-required options.
  # config.vm.synced_folder "../data", "/vagrant_data"

  # Customize the amount of memory on the VM:
  config.vm.provider "virtualbox" do |vb|
    vb.memory = "4096"
    vb.cpus = "2"
  end

  # Config
  config.vm.network "forwarded_port", id: "ssh", host: 2212, guest: 22  # custom ssh port
  config.vm.network "private_network", ip: "192.168.56.10"
  config.vm.hostname = PROJECT_HOSTNAME
  config.vm.synced_folder "./", "/vagrant", id: "vagrant-root", owner: "vagrant", group: "www-data", :mount_options => ["dmode=775", "fmode=664"]

  
  # Auto setup vhosts at: /etc/hosts
  # https://github.com/devopsgroup-io/vagrant-hostmanager
  config.hostmanager.enabled = true
  config.hostmanager.manage_host = true
  config.hostmanager.aliases = PROJECT_HOSTNAME

  # Setup server
  config.vm.provision "shell", path: ".vagrant-scripts/bootstrap.sh", args: [PROJECT_HOSTNAME, PROJECT_HOSTNAME_ALIAS]
  config.vm.provision "shell", path: ".vagrant-scripts/elastic-setup.sh"
  config.vm.provision "shell", path: ".vagrant-scripts/mysql-setup.sh"
  config.vm.provision "shell", path: ".vagrant-scripts/supervisor-setup.sh"

  # Setup project
  # config.vm.provision "shell", path: ".vagrant-scripts/project-setup.sh"

end
