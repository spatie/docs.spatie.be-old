---
title: Optimizing images
---

## Requirements

Optimization of images works by passing the images to these binaries:

- [`advpng`](http://advancemame.sourceforge.net/doc-advpng.html)
- [`gifsicle`](http://www.lcdf.org/gifsicle/)
- [`jpegoptim`](http://freecode.com/projects/jpegoptim)
- [`jpegtran`](http://jpegclub.org/jpegtran/)
- [`optipng`](http://optipng.sourceforge.net/)
- [`pngcrush`](http://pmt.sourceforge.net/pngcrush/)
- [`pngout`](http://www.jonof.id.au/kenutils)
- [`pngquant`](http://pngquant.org/)

Allthough it would a good idea to install them all, it's not required. If one of these binaries is present on your system it will be used.

## How to use

To shave off some kilobytes of the images the package can optimize images by calling the `optimize` method.

Here's the original file we're going to work with:

![Example Image](https://docs.spatie.be/images/image/example.jpg)


It's size is current 622 Kb. Let's optimize it.

```php
Image::load('example.jpg')
    ->optimize()
    ->save('example-optimized.jpg');
```

![Optimized Image](https://docs.spatie.be/images/image/example-optimized.jpg).

The size of the optimized image is 573 Kb.

## Customizing the optimization

To optimization of images is done by the underlying [psliwa/image-optimizer](https://github.com/psliwa/image-optimizer) package. You can pass all the [configuration parameters](https://github.com/psliwa/image-optimizer) of that package to the `optimize` method of this package.

```php
Image::load('example.jpg')
    ->optimize(['ignore_errors' => false])
    ->save();
```