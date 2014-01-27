# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  config.vm.box = "raring64"

  config.vm.box_url = "http://cloud-images.ubuntu.com/vagrant/raring/current/raring-server-cloudimg-amd64-vagrant-disk1.box"

  config.vm.network :private_network, ip: "192.168.33.11"


  config.ssh.forward_agent = true

  config.vm.synced_folder ".", "/vagrant", id: "vagrant-root",
    mount_options: ["dmode=777,fmode=777"]

  config.vm.provider :virtualbox do |vb|

    vb.customize ["modifyvm", :id, "--memory", 1536]
    vb.customize ["setextradata", :id, "VBoxInternal2/SharedFoldersEnableSymlinksCreate/v-root", "1"]
    vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
  end

  config.vm.provision :puppet do |puppet|
    puppet.manifests_path = "puppet/manifests"
    puppet.module_path  = "puppet/modules"
    puppet.manifest_file  = "site.pp"
    puppet.options = [
      "--environment development",
    ]
  end
end
