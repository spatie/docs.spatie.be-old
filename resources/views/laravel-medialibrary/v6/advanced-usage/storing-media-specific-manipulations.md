---
title: Storing media specific manipulations
---


Imagine you need to apply a 90 degree rotation to a single image. Sp the rotation should be applied to one specific `Media` and not to all media linked to the given `$newsItem`.

When adding an image to the medialibrary, you can use `withManipulations` to set any media specific manipulations.

Here's a quick axample

```php
$mediaItem = $newsItem->addMedia($pathToFile)
                      ->withManipulations([
                           'thumb' => ['orientation' => '90'],
                      );
```

The package will regenerate all files using the saved manipulation as the first manipulation when creating a derived image.

You can also apply media specific manipulations to an existing `Media` instance.

```php
$mediaItems = $newsItem->getMedia('images');
$mediaItems[0]->manipulations = [
   'thumb' => [ 'orientation' => '90'],
];

// This will cause the thumb conversions to be regenerated.
$mediaItems[0]->save();
```

First the rotation will be applied for this specific `$mediaItem`, then the the other manipulations you specific in the `thumb` conversion.


