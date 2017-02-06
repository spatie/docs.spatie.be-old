---
title: Applying manipulations
---

By default every manipulation will only be applied once to your image. When calling a manipulation method multiple times only the last call will be applied when the image is saved.

For example:

```php
// This will only lower the brightness by 20%
Image::load('example.jpg')
    ->brightness(-40)
    ->brightness(-20)
    ->save();
```

![Example](https://docs.spatie.be/images/image/example-brightness.jpg)

## The `apply` method

The `apply` method will apply all previous manipulations to the image before continuing with the next manipulations.

For example:

```php
// This will lower the brightness by 40%, then lower it again by 20%
Image::load('example.jpg')
    ->brightness(-40)
    ->apply()
    ->brightness(-20)
    ->save();
```

![Example](https://docs.spatie.be/images/image/example-advanced-manipulations.jpg)
