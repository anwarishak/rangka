# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = "2"
PATH_TO_UNIVERSAL_VAGRANT = "/www/universal-vagrant/"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  # Basic box
  config.vm.box = "precise32"
  config.vm.box_url = "http://files.vagrantup.com/precise32.box"

  # Networking: port forwarding
  config.vm.network :forwarded_port, guest: 80, host: 8080, auto_correct: true

  # Synced folders
  config.vm.synced_folder PATH_TO_UNIVERSAL_VAGRANT, "/universal-vagrant"

  config.vm.provider :virtualbox do |vb|
    vb.customize ["modifyvm", :id, "--memory", "512"]
    vb.customize ["modifyvm", :id, "--hwvirtex", "off"]
  end

  config.ssh.shell = "bash -c 'BASH_ENV=/etc/profile exec bash'"
  config.vm.provision :shell, :path => PATH_TO_UNIVERSAL_VAGRANT + "scripts/bootstrap.sh"
  config.vm.provision :shell, :path => PATH_TO_UNIVERSAL_VAGRANT + "scripts/apache.sh"
  config.vm.provision :shell, :path => PATH_TO_UNIVERSAL_VAGRANT + "scripts/mysql.sh"
  config.vm.provision :shell, :path => PATH_TO_UNIVERSAL_VAGRANT + "scripts/php.sh"

  # Do extra bits of provisioning/configuration, if required

  $script = "
  echo \"Doing some last minute provisioning\"
  rm /var/www/default/public_html
  ln -fs /vagrant/webroot /var/www/default/public_html
  service apache2 restart
  "

  # Uncomment the next line to enable the extra bits of provisioning/configuration
  #config.vm.provision "shell", inline: $script

end