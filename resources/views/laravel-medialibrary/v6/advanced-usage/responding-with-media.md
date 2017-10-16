---
title: Responding with media
---

The media class implements the `Responsable` interface. This means that you can return a media object as a response.

```php
class SomeController
{
   public function someAction($id)
   {
      return Media::findOrFail($id);
   }
}
```
