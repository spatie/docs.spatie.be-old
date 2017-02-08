---
title: Converting other files (Article model)
---

When using other files like videos or PDFs you'll often want to generate a still image or thumbnail. Medialibrary can do this for you.

## Requirements

### Imagick

As a start you'll need to have [`Imagick`](http://php.net/manual/en/imagick.setup.php) installed on your system. `Imagick` is used to convert `SVG` and `PDF` files to images. You can check whether it's installed by checking the output of `phpinfo()`:

![Imagick in phpinfo](https://docs.spatie.be/images/medialibrary/tutorial/imagick-enabled.jpg)

When using the command line (for example in this demo) make sure the `Imagick` extension is also enabled there by running the following command:

```bash
php -me | grep 'imagick'
```

If `imagick` is printed to the console you're good.

### FFmpeg

To generate still frames from video files you'll need the `FFmpeg` framework on your system. Please refer to their [official website](https://ffmpeg.org/download.html) for instructions. You can check whether `FFmpeg` is installed by running the following command:

```bash
ffmpeg -version
```

![ffmpeg installed](https://docs.spatie.be/images/medialibrary/tutorial/ffmpeg-version.jpg)

Remember to add the `php-ffmpeg` package as a dependency to your project as well:

```bash
composer require php-ffmpeg/php-ffmpeg
```

We've already done this for you in the demo project.

## Defining the conversions

As usual we've prepared an `Article` model which for you that implements the `HasMediaConversions` interface and has a `registerMediaConversions` method. The `Article` features some downloadable files for which we want to generate thumbnails.

```php
$this->addMediaConversion('thumbnail')
    ->width(360)
    ->height(230)
    ->extractVideoFrameAtSecond(5) // Grab the still frame from the 5th second in the video
    ->performOnCollections('downloads');
```

You'll notice that the conversions look very similar to image conversions. The only difference being that we've specified a time when the still image should be generated from the video files using `extractVideoFrameAtSecond()`.

## Adding media to the `Article`

Use the `article:addmedia` command to add some `SVG` (`demofiles/logo.svg`), `WEBM` (`demofiles/coolvideo.webm`) or `PDF` (`demofiles/hamlet.pdf`) files to the `Article`.

```bash
php artisan article:addmedia demofiles/coolvideo.webm
```

![article addmedia](https://docs.spatie.be/images/medialibrary/tutorial/article-addmedia.jpg)

If we check the storage disk now we'll find the media file and the specified conversion as a `JPG` image. It's that simple.
