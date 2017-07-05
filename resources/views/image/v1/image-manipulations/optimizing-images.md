---
title: Optimizing images
---

## Requirements

Optimization of images works by passing the images to these binaries: [`advpng`](http://advancemame.sourceforge.net/doc-advpng.html), [`gifsicle`](http://www.lcdf.org/gifsicle/), [`jpegoptim`](http://freecode.com/projects/jpegoptim), [`jpegtran`](http://jpegclub.org/jpegtran/), [`optipng`](http://optipng.sourceforge.net/), [`pngcrush`](http://pmt.sourceforge.net/pngcrush/), [`pngout`](http://www.jonof.id.au/kenutils) and [`pngquant`](http://pngquant.org/)

Allthough it would a good idea to install them all, it's not required. If one of these binaries is present on your system it will be used.

## How to use

To shave off some kilobytes of the images the package can optimize images by calling the `optimize` method.

Here's the original image of New York used in all examples has a size of 622 Kb. Let's optimize it.

```php
Image::load('example.jpg')
    ->optimize()
    ->save('example-optimized.jpg');
```

![Optimized Image](https://docs.spatie.be/images/image/example-optimized.jpg).

The size of the optimized image is 573 Kb.

No matter where or how many times you call `optimize` in you chain, it will always be performed as the last operation once.


## Customizing the optimization

To optimization of images is done by the underlying [spatie/image-optimizer](https://github.com/spatie/image-optimizer) package. You can pass your own customized chains as array. The keys should be fully qualified class names of optimizers and the values the options that they should get. Here's an example

```php
Image::load('example.jpg')
    ->optimize([Jpegoptim::class => [
        '--all-progressive',
    ]])
    ->save();
```
