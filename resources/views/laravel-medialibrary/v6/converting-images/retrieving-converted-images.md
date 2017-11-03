---
title: Retrieving converted images
---

You can retrieve the url or path to a converted image by specifying the conversion name in the `getUrl`, `getTemporaryUrl` (only available when using an S3 disk) and `getPath` functions:

```php
$mediaItems = $newsItem->getMedia('images');
$mediaItems[0]->getUrl('thumb');
$mediaItems[0]->getPath('thumb'); // Absolute path on its disk
$mediaItems[0]->getTemporaryUrl(Carbon::now()->addMinutes(5), 'thumb'); // Temporary S3 url
```

Because retrieving an url for the first media item in a collection is such a common scenario, the `getFirstMediaUrl` convenience-method is provided. The first parameter is the name of the collection, the second is the name of a conversion. There's also a `getFirstMediaPath`-variant that returns the absolute path on its disk and a `getFirstTemporaryURL`-variant which returns an temporary S3 url.

```php
$urlToFirstListImage = $newsItem->getFirstMediaUrl('images', 'thumb');
$urlToFirstTemporaryListImage = $newsItem->getFirstTemporaryUrl(Carbon::now()->addMinutes(5), 'images', 'thumb');
$fullPathToFirstListImage = $newsItem->getFirstMediaPath('images', 'thumb');
```
