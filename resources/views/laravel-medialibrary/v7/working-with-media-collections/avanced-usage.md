---
title: Advanced usage
---

A collection can be more than [just a name to group files](TODO: add to basic usage). By defining a media collection in your model you can add certain behaviour collections.

To get started with media collections add a function called `registerMediaCollections` to [your prepared model](TODO: add link). Inside that function you can use `addMediaCollection` to start  a media collection.

```php
// in your model

public function registerMediaCollections()
{
    $this->addMediaCollection('my-collection')
        //add options
        ...

    // you can define as much collections as needed
    $this->addMediaCollection('my-other-collection')
        //add options
        ...
}
```

## Only allow certain files in a collection

You can pass a callback to `acceptsFile` that will check if files are allowed into the collection. In this example we only accept `jpeg` files.

```php
use Spatie\MediaLibrary\File;
...
public function registerMediaCollections()
{
    $this
        ->addMediaCollection('only-jpegs-please')
        ->acceptsFile(function (File $file) {
            return $file->mimeType === 'image/jpeg';
        });
}
```

This will succeed:

```php
$yourModel->addMedia('beautiful.jpg')->toMediaCollection('only-jpegs-please');
```

This will throw a `Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection` exception.

```php
$yourModel->addMedia('ugly.ppt')->toMediaCollection('only-jpegs-please');
```

## Using a specific disk

You can ensure that files added to a collection automatically get added to a certain disk.

This is how you'd define the media collection.

```php
// in your model

public function registerMediaCollections()
{
    $this
       ->addMediaCollection('big-files')
       ->useDisk('s3');
}
```

When adding a file to `my-collection` it will be stored on the `s3` disk.

```php
$yourModel->addMedia($pathToFile)->toMediaCollection('big-files');
```

You can still specify the disk name manually when adding media. In this example the file will be stored on `alternative-disk` instead of `s3`.

```php
$yourModel->addMedia($pathToFile)->toMediaCollection('big-files', 'alternative-disk');
```

## Single file collections

If you want a collection to hold only one file you can use `singleFile` on the collection. A good use case for this would be an avatar collection on a `User` model. In most cases you'd want to have a user to only have one `avatar`.

```php
// in your model

public function registerMediaCollections()
{
    $this
        ->addMediaCollection('avatar')
        ->singleFile();
}
```

The first time you add a file to the collection it will be stored as usual.

```php
$yourModel->add($pathToImage)->toMediaCollection('avatar');
$yourModel->getMedia('avatar')->count() // returns 1
$yourModel->getFirstUrl('avatar') // will return an url to the `$pathToImage` file
```

When adding another file to a single file collection the first one will be deleted.

```php
// this will remove other files in the collection
$yourModel->add($anotherPathToImage)->toMediaCollection('avatar');
$yourModel->getMedia('avatar')->count() // returns 1
$yourModel->getFirstUrl('avatar') // will return an url to the `$anotherPathToImage` file
```

## Registering media conversions

It's recommended that your first read the section on [converting images](TODO: add link) before reading this section.

Normally image conversions are registered inside the `registerMediaConversions` function on your model. However, images conversions can also be registered inside media collections.

```php
public function registerMediaCollections()
{
    $this
        ->addMediaCollection('my-collection')
        ->registerMediaConversions(function (Media $media) {
            $this
                ->addMediaConversion('thumb')
                ->width(100)
                ->height(100);
        });
}
```

When adding an image to `my-collection` a thumbnail that fits inside 100x100 will be created

```php
$yourModel->add($pathToImage)->toMediaCollection('my-collection');

$yourModel->getFirstMediaUrl('thumb') // returns an url to a 100x100 version of the added image.
```

Take a look at the [defining conversions section](TODO: add link) to learn all the function you can tack on to `addMediaConversion`.
