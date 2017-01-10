---
title: Adding custom properties
---

When adding a file to the medialibrary you can pass an array with custom properties:

```php
$mediaItem = $newsItem
    ->addMedia($pathToFile)
    ->withCustomProperties(['mime-type' => 'image/jpeg'])
    ->toMediaLibrary();
```

There are some convenience methods to work with custom properties:

```php
$mediaItem->hasCustomProperty('mime-type'); // returns true
$mediaItem->getCustomProperty('mime-type'); // returns 'image/jpeg'

$mediaItem->hasCustomProperty('does not exists'); // returns false
$mediaItem->getCustomProperty('does not exists'); // returns null
```

You can also specify a default value when retrieving a custom property.

```php
$mediaItem->getCustomProperty('isPublic', false);
```

If you're dealing with nested custom properties, you can use dot notation in the alternative `nestedCustomProperty` methods:

```php
$mediaItem = $newsItem
    ->addMedia($pathToFile)
    ->withCustomProperties([
        'nested' => ['mime-type' => 'image/jpeg']
    ])
    ->toMediaLibrary();

$mediaItem->hasCustomProperty('file.mime-type'); // returns true
$mediaItem->getCustomProperty('file.mime-type'); // returns 'image/jpeg'

$mediaItem->hasCustomProperty('file.does-not-exist'); // returns false
$mediaItem->getCustomProperty('file.does-not-exist'); // returns null
```