---
title: Retrieving media
---

To retrieve files you can use the `getMedia`-method:

```php
$mediaItems = $newsItem->getMedia();
```

The method returns a collection of `Media`-objects.

You can retrieve the url and path to the file associated with the `Media`-object using  `getUrl`, `getTemporaryUrl` (for S3 only) and `getPath`:

```php
$publicUrl = $mediaItems[0]->getUrl();
$fullPathOnDisk = $mediaItems[0]->getPath();
$temporaryS3Url = $mediaItems[0]->getTemporaryUrl(Carbon::now()->addMinutes(5));
```

Since retrieving the first media and the url for the first media for a object is such a common scenario, the `getFirstMedia` and `getFirstMediaUrl` convenience-methods are also provided:

```php
$media = $newsItem->getFirstMedia();
$url = $newsItem->getFirstMediaUrl();
```

An instance of `Media` also has a name, by default its filename:

```php
echo $mediaItems[0]->name; // Display the name

$mediaItems[0]->name = 'new name';
$mediaItems[0]->save(); // The new name gets saved. Activerecord ftw!
```

The name of a `Media` instance can be changed when it's added to the medialibrary:

```php
$newsItem
   ->addMedia($pathToFile)
   ->usingName('new name')
   ->toMediaCollection();
```

The name of the uploaded file can be changed via the media-object:

```php
$mediaItems[0]->file_name = 'newFileName.jpg';
$mediaItems[0]->save(); // Saving will also rename the file on the filesystem.
```

The name of the uploaded file can also be changed when it gets added to the media-library:

```php
$newsItem
   ->addMedia($pathToFile)
   ->usingFileName('otherFileName.txt')
   ->toMediaCollection();
```

You can sanitize the filename using a callable:

```php
$newsItem
   ->addMedia($pathToFile)
   ->sanitizingFileName(function($fileName) {
      return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
   })
   ->toMediaCollection();
```

You can also retrieve the size of the file via  `size` and `human_readable_size` :

```php
$mediaItems[0]->size; // Returns the size in bytes
$mediaItems[0]->human_readable_size; // Returns the size in a human readable format (eg. 1,5 MB)
```

An instance of `Media` also contains the mime type of the file.

```php
$mediaItems[0]->mime_type; // Returns the mime type
```

You can remove something from the library by simply calling `delete` on an instance of `Media`:

```php
$mediaItems[0]->delete();
```

When a `Media` instance gets deleted all related files will be removed from the filesystem.

Deleting a model with associated media, will also delete all associated files.

```php
$newsItem->delete(); // all associated files will be deleted as well
```

If you want to remove all associated media in a specific collection you can use the `clearMediaCollection` method. It also accepts the collection name as an optional parameter:

```php
$newsItem->clearMediaCollection(); // all media will be deleted
```

Also, there is a `clearMediaCollectionExcept` method which can be useful if you want to remove only few or some selected media in a collection. It accepts the collection name as the first argument and the media instance or collection of media instances which should not be removed as the second argument:

```php
$newsItem->clearMediaCollectionExcept('images', $newsItem->getFirstMedia()); // This will remove all associated media in the 'images' collection except the first media
```
