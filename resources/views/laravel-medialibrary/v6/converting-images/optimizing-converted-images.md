---
title: Optimizing converted images
---

The medialibrary will shave off some kilobyes of the converted images by running them through a chain of various image optimization tools.

The optimization will only be applied on converted images, the package will not modify your original files. If you want to avoid optimization of a conversion just tack `nonOptimized` to the  conversion.

```php
public function registerMediaConversions(Media $media = null)
{
   $this->addMediaConversion('thumb')
      ->width(368)
      ->height(232)
      ->sharpen(10)
      ->nonOptimized();
}
```

The package will use these optimizers if they are present on your system:

- [JpegOptim](http://freecode.com/projects/jpegoptim)
- [Optipng](http://optipng.sourceforge.net/)
- [Pngquant 2](https://pngquant.org/)
- [SVGO](https://github.com/svg/svgo)
- [Gifsicle](http://www.lcdf.org/gifsicle/)

Head over to [the installation page](https://docs.spatie.be/laravel-medialibrary/v6/installation-setup#optimization-tools) to learn how to install these.

## Which tools will do what?

The package will automatically decide which tools to use on a particular image.

### JPGs

JPGs will be made smaller by running them through [JpegOptim](http://freecode.com/projects/jpegoptim). These options are used:
- `--strip-all`: this strips out all text information such as comments and EXIF data
- `--all-progressive`: this will make sure the resulting image is a progressive one, meaning it can be downloaded using multiple passes of progressively higher details.

### PNGs

PNGs will be made smaller by running them through two tools. The first one is [Pngquant 2](https://pngquant.org/), a lossy PNG compressor. We set no extra options, their defaults are used. After that we run the image through a second one: [Optipng](http://optipng.sourceforge.net/). These options are used:
- `-i0`: this will result in a non-interlaced, progressive scanned image
- `-o2`: this set the optimization level to two (multiple IDAT compression trials)

### SVGs

SVGs will be minified by [SVGO](https://github.com/svg/svgo). SVGO's default configuration will be used, with the omission of the `cleanupIDs` plugin because that one is known to cause troubles when displaying multiple optimized SVGs on one page.

Please be aware that SVGO can break your svg. You'll find more info on that in this [excellent blogpost](https://www.sarasoueidan.com/blog/svgo-tools/) by [Sara Soueidan](https://twitter.com/SaraSoueidan).

### GIFs

GIFs will be optimized by [Gifsicle](http://www.lcdf.org/gifsicle/). These options will be used:
- `-O3`: this sets the optimization level to Gifsicle's maximum, which produces the slowest but best results.
