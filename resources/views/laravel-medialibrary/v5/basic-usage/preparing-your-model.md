---
title: Preparing your model
---

To associate media with a model, the model must implement the following interface and trait:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class News extends Model implements HasMedia
{
    use HasMediaTrait;
   ...
}
```

If you want to leverage [image conversions](https://docs.spatie.be/laravel-medialibrary/v4/converting-images/defining-conversions), implement the `HasMediaConversions` interface instead of `HasMedia`.
