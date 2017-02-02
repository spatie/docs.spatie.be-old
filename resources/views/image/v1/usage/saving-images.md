---
title: Saving images
---

By default calling the `save` method on the `Image`  will apply all manipulations to your original image file. 

```php
Image::load('example.jpg')
    ->sepia()
    ->save();
```

To save the image as a copy in a new location pass in the optional `$outputPath`.

```php
Image::load('example.jpg')
    ->sepia()
    ->save('sepia-example.jpg');
```

## Save image as a different format

To save you image as a different image format call the `format` method and pass in the desired format. Currently the following formats are supported: `FORMAT_JPG`, `FORMAT_PJPG`, `FORMAT_PNG` and `FORMAT_GIF`.

```php
Image::load('example.jpg')
    ->format(Image::FORMAT_PNG)
    ->save('example.png');
```

Alternatively you can change the image format by saving the image with a different file extension than the original image. The `Image` package will then attempt to convert the image to the correct image format.

```php
Image::load('example.jpg')
    ->save('converted-example.png'); // Will convert the original image to PNG
```

## Changing JPEG quality

By calling the `quality` method on the `Image` you can specify the JPEG quality in percent. This only applies to saving JPEG files. 

The `$quality` argument should be an integer ranging from `0` to `100`.

```php
Image::load('example.jpg')
    ->quality(20)
    ->save();
```

![Original](https://docs.spatie.be/images/image/example.jpg)
