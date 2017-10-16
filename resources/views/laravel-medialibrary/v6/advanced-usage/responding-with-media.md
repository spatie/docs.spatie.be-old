---
title: Responding with media
---

`Media` implements the `Responsable` interface. This means that you can return a media object as a response.

```php
use Spatie\MediaLibrary\Media;

class DownloadMediaController
{
   public function show(Media $mediaItem)
   {
      return mediaItem;
   }
}
```
