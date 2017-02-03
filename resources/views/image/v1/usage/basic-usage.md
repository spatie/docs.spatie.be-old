---
title: Basic usage
---

## Loading the image

Load an image by calling the static `load` method on the `Image` and passing in the `$pathToImage`.

```php
$image = Image::load(string $pathToImage);
```

## Applying manipulations

Any of the [image manipulations](/image/v1/image-manipulations/overview) can be applied to the loaded `Image` by calling the manipulation's method. All image manipulation methods can be chained.

```php
Image::load('example.jpg')
    ->sepia()
    ->blur(50)
    ->save();
```

![Sepia + blur manipulation](https://docs.spatie.be/images/image/example-sepia-blur.jpg)

## Saving the image

To save the image as a copy, in a different image format or with a different jpeg quality [see saving images](/image/v1/usage/saving-images).
