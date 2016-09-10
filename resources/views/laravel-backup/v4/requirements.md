---
title: Requirements
---

The backup package requires **PHP 7 or higher** and **Laravel 5.3 or higher**.

The package needs free disk space to operate. Make sure that you have at least as much free space as the total size of the files you want to backup.

Make sure `mysqldump` is installed on your system if you want to backup MySQL databases.

Make sure `pg_dump` is installed on your system if you want to backup PostgreSQL databases.

To send notifications to Slack you'll need to install `guzzlehtpp/guzzle` v6:

```bash
composer require guzzlehttp/guzzle
```
