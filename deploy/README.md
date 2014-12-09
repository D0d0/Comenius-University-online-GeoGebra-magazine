INSTALLATION
============

#### ANSIBLE INSTALLATION ####
Taken from [here] (http://docs.ansible.com/intro_installation.html#installing-the-control-machine "source"), following should be the installation steps:

```bash
$ sudo apt-get install software-properties-common
$ sudo apt-add-repository ppa:ansible/ansible
$ sudo apt-get update
$ sudo apt-get install ansible
```

#### CLONE ####

```bash
$ git clone --recursive https://github.com/mrkvost/deploy.git deploy
```

#### SETTINGS ####
Edit sensitive data in vars/sensitive.yml such as git user and git password:

```bash
$ cd deploy
$ vim vars/sensitive.yml
```

Specify host in file inventory:
```bash
$ vim inventory
```

#### RUN PLAYBOOK ####

```
$ ansible-playbook -i inventory geogebra.yml -u root
```
