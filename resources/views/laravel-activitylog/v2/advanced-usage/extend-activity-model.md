---
title: Extend the activity model
---

The package is shipped with a default model `Spatie\Activitylog\Models\Activity`.

If you want you can use your own model to log the activities.

Your model has only to implement `Spatie\Activitylog\Contracts\Activity` interface and it has to extend the `Illuminate\Database\Eloquent\Model` class.

Here's an example:

```php
namespace App;

use Spatie\Activitylog\Contracts\Activity as ActivityContract;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class MyActivity extends Model implements ActivityContract
{
    protected $table;
    public $guarded = [];
    protected $casts = [
        'properties' => 'collection',
    ];
}
```

Then you have to change the config and set your model for logging the activities.

```php
/*
     * This model will be used to log activity. The only requirement is that
     * it should be or extend the Spatie\Activitylog\Models\Activity model.
     */
    'activity_model' => \App\MyActivity::class,
```