---
title: Image generators
---

As explained in the [Defining conversions](/laravel-medialibrary/v4/converting-images/defining-conversions/) section 
Medialibrary use [Glide](http://glide.thephpleague.com/) under the hood which only perform conversions on images files. 

To generate conversions of other media type (like a video), Medialibrary use an internal feature called `Image Generator`
which create a derived image file of the media. 

Conversion of specific file type are defined in the exact same way as images:
```php
$this->addMediaConversion('thumb')
     ->setManipulations(['w' => 368, 'h' => 232])
     ->performOnCollections('videos');
```

Medialibrary include image generators for the following file types:
- [PDF](/laravel-medialibrary/v4/converting-other-medias/image-generators#pdf)
- [SVG](/laravel-medialibrary/v4/converting-other-medias/image-generators#svg)
- [Video](/laravel-medialibrary/v4/converting-other-medias/image-generators#video)

## PDF

The only requirement to perform a conversion of a PDF file is [imagick](http://php.net/manual/en/imagick.setresolution.php).

## SVG

The only requirement to perform a conversion of a SVG file is [imagick](http://php.net/manual/en/imagick.setresolution.php).

## Video

The video image generator use the [PHP-FFMpeg](https://github.com/PHP-FFMpeg/PHP-FFMpeg) package that you can install via composer:

```bash
$ composer require php-ffmpeg/php-ffmpeg
```

you also need to follow `FFmpeg` installation instruction on their [official website](https://ffmpeg.org/download.html).

The video image generator allow you to choose at which time of the video the derived file should be created using the `setExtractVideoFrameAtSecond` on the conversion.

```php
$this->addMediaConversion('thumb')
     ->setManipulations(['w' => 368, 'h' => 232])
     ->setExtractVideoFrameAtSecond(20)
     ->performOnCollections('videos');
```

Once the conversion created you can easily use the thumbnail in a html `video` tag for example:

```html
<video controls poster="{{ $video->getUrl('thumb') }}">
  <source src="{{ $video->getUrl() }}" type="video/mp4">
  Your browser does not support the video tag.
</video>
```
