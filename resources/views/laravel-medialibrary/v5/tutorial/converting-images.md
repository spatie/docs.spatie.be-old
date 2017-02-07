---
title: Converting images
---

When working with images you'll often find yourself needing a couple different versions of the same image. You might for example need a smaller thumbnail with a fixed aspect ratio and a wide, blurred banner. This can be achieved by using conversions.

When adding a `jpg`, `png`, `svg`, `pdf`, `mp4 `, `mov` or `webm` file to the medialibrary, the conversions will automatically kick in and generate your derived versions in `jpg` format.

We've already prepared a `PhotoAlbum` model for you that implements the `HasMediaConversions` interface and has a `registerMediaConversions` method. Feel free to modify these conversions. All [manipulation methods from `spatie/image`](https://docs.spatie.be/image/v1/image-manipulations/overview) can be applied.

```php
public function registerMediaConversions()
{
    $this->addMediaConversion('thumbnail')
        ->width(300)
        ->height(200)
        ->sharpen(10);

    $this->addMediaConversion('banner')
        ->fit(Manipulations::FIT_CROP, 800, 200)
        ->apply()
        ->blur(40);
}
```

More information about defining conversions can be read [in the documentation](https://docs.spatie.be/laravel-medialibrary/v5/converting-images/defining-conversions).

## Adding and converting images (`PhotoAlbumAddImage.php`)

To see the conversions in action run the `addimage` command:

```bash
php artisan photoalbum:addimage demofiles/otter.jpg
```

![Photoalbum add image](https://docs.spatie.be/images/medialibrary/tutorial/photoalbum-addimage.jpg)

The medialibrary has automatically created a conversions folder with the derived `jpg` images. Feel free to add another image format as well. A `gif` for example:

```bash
php artisan photoalbum:addimage demofile/otter.gif
```

![Photoalbum add image](https://docs.spatie.be/images/medialibrary/tutorial/photoalbum-addimage-gif.jpg)

As you can see the medialibrary has generated still `jpg` conversions from the `gif` with the correct image manipulations applied, amazing!

## Regenerating conversions

After adding a couple of images you might want to change some conversions. Feel free to modify the conversions in the `PhotoAlbum` model. When you're done run the following command to regenerate all conversions on existing media files:

```bash
php artisan medialibrary:regenerate
```

![Medialibrary regenerate](https://docs.spatie.be/images/medialibrary/tutorial/medialibrary-regenerate.jpg)
