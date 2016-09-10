---
title: Adding extra files to a backup
---

When performing a backup, the package will create a manifest of all the files that have been selected for backup. After the manifest is created, a zip file will be made containing all the files from the manifest. The zip file will be copied to the configured backup destinations.

Right after the manifest is created, and before the zip file is created, the `Spatie\Backup\Events\BackupManifestWasCreated` event will be fired. This is what it looks like:

```
namespace Spatie\Backup\Events;

use Spatie\Backup\Tasks\Backup\Manifest;

class BackupManifestWasCreated
{
    /** @var \Spatie\Backup\Tasks\Backup\Manifest */
    public $manifest;

    public function __construct(Manifest $manifest)
    {
        $this->manifest = $manifest;
    }
}

```

You can use that event to add extra files to the manifest.

```php
use Spatie\Backup\Events\BackupManifestWasCreated;

Event::listen(BackupManifestWasCreated::class, function (BackupManifestWasCreated $event) {
   $event->manifest->addFiles([$path1, $path2, ...]);
});
```
