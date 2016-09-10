---
title: Taking backups
---

You can backup your app by running:

```bash
php artisan backup:run
```

If you want to backup to a specific disk instead of all disks, run:

```bash
php artisan backup:run --only-to-disk=name-of-your-disk
```

If you only need to backup the database run:

```bash
php artisan backup:run --only-db
```

If you only need to backup the files, and want to skip dumping databases, run:

```bash
php artisan backup:run --only-files
```

<div class="alert -warning">
Be very careful with `--only-db` and `--only-files`. When monitoring backups the package will not make
a distinction between full backups and a backup with only files or databases.
</div>


## Configuration

### Determining the content of the backup

This is the portion of the configuration that will determine which files and databases will be backed up. Most options should be self explanatory.

```php
'backup' => [

     /*
      * The name of this application. You can use this name to monitor
      * the backups.
      */
     'name' => env('APP_URL'),

     'source' => [

         'files' => [

             /*
              * The list of directories and files that will be included in the backup.
              */
             'include' => [
                 base_path(),
             ],

             /*
              * These directories and files will be excluded from the backup.
              */
             'exclude' => [
                 base_path('vendor'),
                 base_path('node_modules'),
             ],

             /*
              * Determines if symlinks should be followed.
              */
             'followLinks' => false,
         ],

         /*
          * The names of the connections to the databases that should be backed up
          * Only MySQL- and PostgreSQL-databases are supported.
          */
         'databases' => [
             'mysql',
         ],
     ],

        'destination' => [

            /*
             * The disk names on which the backups will be stored.
             */
            'disks' => [
                'local',
            ],
        ],
    ]
```

The specified databases will be dumped and, together with the selected files, be zipped. The zip file will be named `<specified name in configuration>/<Y-m-d-H-i-s>.zip`.
 
The more files you need to backup, the bigger the zip file will become. Make sure there's enough free space on your disk to create the zip file. After the zip file has been copied to all destinations it will be deleted.
 
### Determining the destination of the backup

The backup can be copied to one or more filesystems. This is the part of the configuration where you can specify those destination filesystems.

```php
    'destination' => [

       /*
        * The disk names on which the backups will be stored. 
        */
        'disks' => [
            'local'
        ],
    ],
```

The default value of `config('laravel-backup.destination.filesytems)` is an array with only one key: `local`. If you only use the local disk to take backups and that disk crashes you will have nothing left but tears.

We highly recommend to configure some extra disks in `app/config/filesystems.php` and adding their names as a destination filesystem for the backup. Those disks should use external servers or services (such as S3 or Dropbox).

If something goes wrong copying the zip file to a specific filesystem, we will still try to copy over to all other configured filesystems.

## Getting notified when a backup goes wrong

You can receive a notification when a backup goes wrong. Read
the section on [notifications](/laravel-backup/v4/sending-notifications/overview) to find out more.
