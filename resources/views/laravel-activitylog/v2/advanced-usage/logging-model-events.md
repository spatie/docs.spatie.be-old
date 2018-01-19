---
title: Logging model events
---

A neat feature of this package is that it can automatically log events such as when a model is created, updated and deleted.  To make this work all you need to do is let your model use the `Spatie\Activitylog\Traits\LogsActivity`-trait.

As a bonus the package will also log the changed attributes for all these events when setting `$logAttributes` property on the model.

The attributes that need to be logged can be defined either by their name or you can put in a wildcard `'*'` to log any attribute that has changed.

Here's an example:

```php
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class NewsItem extends Model
{
    use LogsActivity;

    protected $fillable = ['name', 'text'];
    
    protected static $logAttributes = ['name', 'text'];
}
```

If you want to log changes to all the `$fillable` attributes of the model, you can specify `protected static $logFillable = true;` on the model. Let's see what gets logged when creating an instance of that model.

```php
$newsItem = NewsItem::create([
   'name' => 'original name',
   'text' => 'Lorum'
]);

//creating the newsItem will cause an activity being logged
$activity = Activity::all()->last();

$activity->description; //returns 'created'
$activity->subject; //returns the instance of NewsItem that was created
$activity->changes(); //returns ['attributes' => ['name' => 'original name', 'text' => 'Lorum']];
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

Calling `$activity->changes()` will return this array:
```php
[
   'attributes' => [
        'name' => 'updated name',
        'text' => 'Lorum',
    ],
    'old' => [
        'name' => 'original name',
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
$activity->changes(); //returns ['attributes' => ['name' => 'updated name', 'text' => 'Lorum']];
```

## Customizing the events being logged

By default the package will log the `created`, `updated`, `deleted` events. You can modify this behaviour by setting the `$recordEvents` property on a model.

```php
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class NewsItem extends Model
{
    use LogsActivity;

    //only the `deleted` event will get logged automatically
    protected static $recordEvents = ['deleted'];
}
```

## Customizing the description

By default the package will log `created`, `updated`, `deleted` in the description of the activity. You can modify this text by overriding the `getDescriptionForEvent` function.

```php
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class NewsItem extends Model
{
    use LogsActivity;

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

## Ignoring changes to certain attributes

If your model contains attributes whose change don't need to trigger an activity being logged you can use `$ignoreChangedAttributes`

```php
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class NewsItem extends Model
{
    use LogsActivity;
    
    protected static $ignoreChangedAttributes = ['text'];

    protected $fillable = ['name', 'text'];
    
    protected static $logAttributes = ['name', 'text'];
}
```

Changing `text` will not trigger an activity being logged.

By default the `updated_at` attribute is _not_ ignored and will trigger an activity being logged. You can simply add the `updated_at` attribute to the `$ignoreChangedAttributes` array to override this behaviour.

## Logging only the changed attributes

If you do not want to log every attribute in your `$logAttributes` variable, but only those that has actually changed after the update, you can use `$logOnlyDirty`

```php
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class NewsItem extends Model
{
    use LogsActivity;

    protected $fillable = ['name', 'text'];
    
    protected static $logAttributes = ['name', 'text'];
    
    protected static $logOnlyDirty = true;
}
```

Changing only `name` means only the `name` attribute will be logged in the activity, and `text` will be left out.

## Using the CausesActivity trait

The package ships with a `CausesActivity` trait which can be added to any model that you use as a causer. It provides an `activity` relationship which returns all activities that are caused by the model.

If you include it in the `User` model you can simply retrieve all the current users activities like this:

```php

\Auth::user()->activity;

```

## Using LogsActivity and CausesActivity on the same model

To log activity for a model that can also cause activity, use the `HasActivity` trait.  It provides an `activity` relationship which is identical to `LogsActivity` and an `actions` relationship for any activity caused by the model.

For example, if you include it in the `User` model you can see all the activity on that model performed by any user by using `activity` but also all changes caused by the user on any models using `actions`.

## Disabling logging on demand

You can also disable logging for a specific model at runtime. To do so, you can use the `disableLogging()` method:

```php
$newsItem = NewsItem::create([
   'name' => 'original name',
   'text' => 'Lorum'
]);

// Updating with logging disabled
$newsItem->disableLogging();

$newsItem->update(['name' => 'The new name is not logged']);
```

You can also chain `disableLogging()` with the `update()` method.

### Enable logging again

You can use the `enableLogging()` method to re-enable logging.

```php
$newsItem = NewsItem::create([
   'name' => 'original name',
   'text' => 'Lorum'
]);

// Updating with logging disabled
$newsItem->disableLogging();

$newsItem->update(['name' => 'The new name is not logged']);

// Updating with logging enabled
$newsItem->enableLogging();

$newsItem->update(['name' => 'The new name is logged']);
```

