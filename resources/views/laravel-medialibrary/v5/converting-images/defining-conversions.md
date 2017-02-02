---
title: Defining conversions
---

When adding files to the medialibrary it can automatically created derived versions such a thumbnails and banners.

If you want to use this functionality your models should implement the `HasMediaConversions` interface instead of `HasMedia`. This interface expects an implementation of the `registerMediaConversions` method.

Here's an example of how a model can implement this.

```php
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class NewsItem extends Model implements HasMediaConversions
{
    use HasMediaTrait;

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
              ->width(368)
              ->height(232);
    }
}
```

Now let's add an image to it

```php
$media = NewsItem::first()->addMedia($pathToImage)->toMediaLibrary();
$media->getPath();  // the path to the where the original image is stored
$media->getPath('thumb') // the path to the converted image 

$media->getUrl();  // the url to the where the original image is stored
$media->getUrl('thumb') // the url to the converted image 
```

Media conversions will be executed whenever  a `jpg`, `png`, `svg`, `pdf`, `mp4 `, `mov` or `webm` file is added to the medialibrary. By default, the conversions will be saved as a `jpg` files.

Internally, [spatie/image](https://docs.spatie.be/image/v1/) is used to manipulate the images. You can use [any manipulation function](TO DO: add link to docs) from that package. 

By default, a conversion will be added to the queue that you've [specified in the configuration](TO DO add link). If you want your image to be created directly (and not on a queue) use `nonQueued` on a conversion.

You can add as many conversions on a model as you'd like. Conversions can also be performed on all specific collections by adding a call to  `performOnCollections`

## Examples

```php
// in your NewsItem model

public function registerMediaConversions()
{
    // perform a resize and filter on images from the 'images' and 'anotherCollection' collections
    // and save them as png files.
    $this->addMediaConversion('thumb')
         ->width(368)
         ->height(232)
         ->greyscale()
         ->format('png')
         ->performOnCollections('images', 'anotherCollection')
         ->nonQueued();

    // perform a resize and sharpen on every collection
    $this->addMediaConversion('adminThumb')
         ->width(50)
         ->height(50)
         ->sharpen(15)
         ->performOnCollections('*');

    // perform a resize on every collection
    $this->addMediaConversion('big')
         ->width(500)
         ->height(500);
}
```