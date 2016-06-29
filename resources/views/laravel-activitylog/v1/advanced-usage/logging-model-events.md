---
title: Logging model events
---

A neat feature of this package is that it can automatically log events such as when a model is created, updated and deleted.  To make this work all you need to do is let your model use the `Spatie\Activitylog\Traits\CausesActivity`-trait.

As a bonus the package will also log the changed attributes for all these events.

Here's an example:

```php
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\CausesActivity;

class NewsItem extends Model
{
    use CausesActivity;

    protected $fillable = ['name', 'text'];
}
```

Let's see what gets logged when creating an instance of that model.

```php
$newsItem = NewsItem::create([
   'name' => 'original name',
   'text' => 'Lorum'
]);

//creating the newsItem will cause an activity being logged
$activity = Activity::all()->last();

$activity->description; //returns 'created'
$activity->subject; //returns the instance of NewsItem that was created
$activity->changes; //returns ['attributes' => ['name' => 'original name', 'text' => 'Lorum']];
```

Now let's update some that `$newsItem`.

```php
$newsItem->name = 'updated name'
$newsItem->save();

//updating the newsItem will cause an activity being logged
$activity = Activity::all()->last();

$activity->description; //returns 'updated'
$activity->subject; //returns the instance of NewsItem that was created
```

Calling `$activity->changes` will return this array:
```php
[
   'attributes' => [
        'name' => 'original name',
        'text' => 'Lorum',
    ],
    'old' => [
        'name' => 'updated name',
        'text' => 'Lorum',
    ],
];
```

Pretty Zonda, right?

Now, what happens when you call delete?

```php
$newsItem->delete();

//deleting the newsItem will cause an activity being logged
$activity = Activity::all()->last();

$activity->description; //returns 'deleted'
$activity->changes; //returns ['attributes' => ['name' => 'updated name', 'text' => 'Lorum']];
```

## Customizing the events being logged

By default the package will log the `created`, `updated`, `deleted` events. You can modify this behaviour by setting the `$recordEvents` property on a model.

```php
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\CausesActivity;

class NewsItem extends Model
{
    use CausesActivity;

    //only the `deleted` event will get logged automatically
    static $recordEvents = ['deleted'];
}
```

## Customizing the description

By default the package will log `created`, `updated`, `deleted` in the description of the activity. You can modify this text by overriding the `getDescriptionForEvent` function.

```php
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\CausesActivity;

class NewsItem extends Model
{
    use CausesActivity;

    protected $fillable = ['name', 'text'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This model has been {$eventName}";
    }

}
```

Let's see what happens now:

```php
$newsItem = NewsItem::create([
   'name' => 'original name',
   'text' => 'Lorum'
]);

//creating the newsItem will cause an activity being logged
$activity = Activity::all()->last();

$activity->description; //returns 'This model has been created'
```

## Customize which attribute changes should be logged

By default the package will log changes of all attributes on a model. If you only need to log specific attributes you can do so by setting the `$logAttributes` property.

```php
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\CausesActivity;

class NewsItem extends Model
{
    use CausesActivity;

    //for all events only changed on the `name` property will get logged
    static $logAttributes = ['name'];
}
```
