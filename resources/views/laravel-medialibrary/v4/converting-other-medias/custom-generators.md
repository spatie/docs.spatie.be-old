---
title: Custom generators
---

If you want to generate a conversion for a file type that is not covered by Medialibrary you can create your own custom
media generator.

For this example, we will create a custom generator that handles the conversions of a PowerPoint file so we can display
a thumbnail of the file content to our users.

## Creating the custom generator

The first step for creating a custom generator is to create it's class, in this example, we will store it in the
`app/ImageGenerators` directory:

```php
<?php

namespace App\ImageGenerators;

use Illuminate\Support\Collection;
use Spatie\MediaLibrary\Conversion\Conversion;
use Spatie\MediaLibrary\ImageGenerators\BaseGenerator;

class PowerPoint extends BaseGenerator
{
    public function convert(string $file, Conversion $conversion = null) : string
    {
        $imageFile = pathinfo($file, PATHINFO_DIRNAME).'/'.pathinfo($file, PATHINFO_FILENAME).'.jpg';

        // Here you should convert the file to an image and return generated conversion path.
        \PowerPoint::convertFileToImage($file)->store($imageFile);

        return $imageFile;
    }

    public function requirementsAreInstalled() : bool
    {
        return true;
    }

    public function supportedExtensions() : Collection
    {
        return collect(['ppt', 'pptx']);
    }

    public function supportedMimeTypes() : Collection
    {
        return collect([
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation'
        ]);
    }
}
```

Make sure that your generator extends the `Spatie\MediaLibrary\ImageGenerators\BaseGenerator` class.

Each method defined as a purpose:

- `convert`: is where you transform the uploaded file to an image.
- `requirementsAreInstalled`: should return true if all the dependencies to perform the conversion are installed.
- `supportedExtensions`: return a collection of file type that should be converted using this custom generator
- `supportedMimeTypes`: return a collection of file mime that should be converted using this custom generator

## Registering the custom generator

If the generator only needs to be applied to one of your models you can override the `getImageGenerators` in that model
like this:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class News extends Model implements HasMedia
{
    use HasMediaTrait;

   ...

   /**
    * Collection of all ImageGenerator drivers.
    */
   public function getImageGenerators() : Collection
   {
       return parent::getImageGenerators()->push(\App\ImageGenerators\PowerPoint::class);
   }
}
```

If you want the generator to be applied to all your model, you can override the `Media` class as explained in the
[using your own model](/laravel-medialibrary/v4/advanced-usage/using-your-own-model/) page and modify the
`getImageGenerators` method in your own `Media` class.
