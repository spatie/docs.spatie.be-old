---
title: Managing hosts
---



## Adding hosts

You can add hosts by running:

```bash
php artisan server-monitor:add-host
```

You'll be prompted for the name of your host, the ssh user and the port that should be used to connect to the server and which checks it should run.

<img src="/images/server-monitor/add-host.jpg" class="screenshot -cli">

On most systems the authenticity of the host will be verified when connecting to it for the first time. To avoid problems while running the check we recommend manually opening up an ssh connection to the server you want to monitor to get past that check.

<img src="/images/server-monitor/authenticity.jpg" class="screenshot -cli">

Although we don't recommend this, you could opt to [disable the host authenticity check](http://linuxcommando.blogspot.be/2008/10/how-to-disable-ssh-host-key-checking.html) altogether. Be aware that this will leave yourself open to man in the middle attacks. If you want to go ahead with this option add `-o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no` to the `ssh_command_suffix` key in the `server-monitor` config file.

## Deleting hosts

Deleting hosts is a simple as running

```bash
php artisan server-monitor:add-host <host-name>
```

where `<host-name>` is the name of the host you which to delete.

## Manually modifying hosts and checks

Instead of using artisan commands you may opt to [manually configure](https://docs.spatie.be/laravel-server-monitor/v1/advanced-usage/manually-configure-hosts-and-checks) the hosts and checks in the database

## Listing hosts and checks

You can list all configured hosts with:

```bash
php artisan server-monitor:list-hosts
``` 

<img src="/images/server-monitor/list-hosts.jpg" class="screenshot -cli">

You can list all configured checks with: 

```bash
php artisan server-monitor:list-checks
``` 

<img src="/images/server-monitor/list-checks.jpg" class="screenshot -cli">
