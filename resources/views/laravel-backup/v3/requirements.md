---
title: Requirements
---

The backup package requires **PHP 5.5.9 or higher** and **Laravel 5.1.20 or higher**.

The package needs free disk space to operate. Make sure that you have at least as many free space as the total size of files you want to backup.

Make sure `mysqldump` is installed on your system if you want to backup MySQL-databases.

Make sure `pg_dump` is installed on your system if you want to backup PostgreSQL-databases.

To send notifications to Slack you'll need to install Maknz's Slack package:

```bash
composer require maknz/slack
```
