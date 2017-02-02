---
title: Using a custom directory structure
---

By default files will be stored inside a directory that uses
the `id` of its `Media`-object as a name. Converted images will be stored inside a directory
named conversions.

```php
media
--- 1
------ file.jpg
------ conversions
--------- small.jpg
--------- medium.jpg
--------- big.jpg
--- 2
------ file.jpg
------ conversions
--------- small.jpg
--------- medium.jpg
--------- big.jpg
...
```

Putting files inside their own folders guaranties that files with the same name can be added without any problems.

To override the default folder structure, a class that conforms to the `PathGenerator`-interface can be specified as the `custom_path_generator_class` in the config file.

Let's take a look at the interface:

```php
namespace Spatie\MediaLibrary\PathGenerator;

use Spatie\MediaLibrary\Media;

interface PathGenerator
{
    /**
     * Get the path for the given media, relative to the root storage path.
     *
     * @param \Spatie\MediaLibrary\Media $media
     *
     * @return string
     */
    public function getPath(Media $media) : string;

    /**
     * Get the path for conversions of the given media, relative to the root storage path.
     *
     * @param \Spatie\MediaLibrary\Media $media
     *
     * @return string
     */
    public function getPathForConversions(Media $media) : string;
}
```

[This example from the tests](https://github.com/spatie/laravel-medialibrary/blob/4.0.0/tests/PathGenerator/CustomPathGenerator.php) uses
the md5 value of media-id to name directories. The directories where conversions are stored will be named `c` instead of the default `conversions`.

There aren't any restrictions on how the directories can be named. When a `Media`-object gets deleted the package will delete its entire associated directory.
So make sure that every media gets its own unique directory.

### PathGenerator for Uuid Folder Structure
Let's say you are not using incrementing Id's on the Media Model but instead you are using Uuid which would generate an Id like `b261dd1b-7876-44ef-aed2-ba34eae050bb` on your Media Model.

You would have to create your custom Generator to properly work with Uuid's like this:

```php
<?php
namespace App\Support;

use Spatie\MediaLibrary\Media;
use Spatie\MediaLibrary\PathGenerator\PathGenerator;

class UuidPathGenerator implements PathGenerator
{
    /**
     * Get the path for the given media, relative to the root storage path.
     *
     * @param  \Spatie\MediaLibrary\Media $media
     * @return string
     */
    public function getPath(Media $media): string
    {
        return $this->getBasePath($media) . '/';
    }

    /**
     * Get the path for conversions of the given media, relative to the root storage path.
     *
     * @param  \Spatie\MediaLibrary\Media $media
     * @return string
     */
    public function getPathForConversions(Media $media): string
    {
        return $this->getBasePath($media) . '/conversions/';
    }

    /*
     * Get a (unique) base path for the given media.
     */
    /**
     * @param  Media   $media
     * @return mixed
     */
    protected function getBasePath(Media $media): string
    {
        return $media->getAttributes()['id'];
    }
}
```

Don't forget to add your UuidPathGenerator to your config file like this `'custom_path_generator_class' => App\Support\UuidPathGenerator::class,`


