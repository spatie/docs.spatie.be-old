---
title: Creating video thumbnails
---

> The creation of video thumbnails require the `FFmpeg` binary and the `PHP-FFMpeg` package.

You can find `FFmpeg` installation instruction on their [official website](https://ffmpeg.org/download.html), and 
`PHP-FFMpeg` can be installed via composer:

```bash
$ composer require php-ffmpeg/php-ffmpeg
```

To create a thumbnail for a video media, simply define a conversion on the collection where the video will be uploaded:

```php
$this->addMediaConversion('thumb')
              ->setManipulations(['w' => 368, 'h' => 232])
              ->performOnCollections('videos');
```

This will extract the first image of the video and save it as one of the video conversion it the same way it works 
when converting images.

You can also define at which second of the video the thumbnail should be extracted using `setExtractVideoFrameAtSecond`:

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
