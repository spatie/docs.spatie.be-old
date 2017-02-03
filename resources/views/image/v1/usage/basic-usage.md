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

Calling the `save` method on an `Image` will save the modifications to the original file. You can save you modified image by passing a `$outputPath` to the `save` method.

```php
Image::load('example.jpg')
    ->width(50)
    ->save('modified-example.jpg');
```

To save the image in a different image format or with a different jpeg quality [see saving images](/image/v1/usage/saving-images).
