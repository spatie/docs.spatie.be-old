---
title: Logging activity
---

## Description

This is the most basic way to log activity:

```php
activity()->log('Look mum, I logged something');
```

You can retrieve the activity using the `Spatie\Activitylog\Models\Activity` model.

```php
$lastActivity = Activity::all()->last(); //returns the last logged activity

$lastActivity->description; //returns 'Look mum, I logged something';
```

## Setting a log name

You can specify a log name by passing it through as a parameter on the activity helper

```php
activity('custom_log_name')
   ->log('edited');

$lastActivity = Activity::all()->last(); //returns the last logged activity

$lastActivity->log_name; //returns 'custom_log_name';
```

The default log `default` will be used if no custom log name is specified.

## Setting a subject

You can specify on which object the activity is performed by using `performedOn`:

```php
activity()
   ->performedOn($someContentModel)
   ->log('edited');

$lastActivity = Activity::all()->last(); //returns the last logged activity

$lastActivity->subject; //returns the model that was passed to `performedOn`;
```

The `performedOn`-function has a shorter alias name: `on`

## Setting a causer

You can set who or what caused the activity by using `causedBy`:

```php
activity()
   ->causedBy($userModel)
   ->performedOn($someContentModel)
   ->log('edited');
   
$lastActivity = Activity::all()->last(); //returns the last logged activity

$lastActivity->causer; //returns the model that was passed to `causedBy`;   
```

The `causedBy()`-function has a shorter alias named: `by`

If you're not using `causedBy` the package will automatically use the logged in user.

## Setting custom properties

You can add any property you want to an activity by using `withProperties`

```php
activity()
   ->causedBy($userModel)
   ->performedOn($someContentModel)
   ->withProperties(['key' => 'value'])
   ->log('edited');
   
$lastActivity = Activity::all()->last(); //returns the last logged activity
   
$lastActivity->getExtraProperty('key'); //returns 'value' 

$lastActivity->where('properties->key', 'value')->get(); // get all activity where the `key` custom property is 'value'
```

## Tap Activity before logged

You can use the `tap()` method to fill properties and add custom fields before the activity is saved.

```php
use Spatie\Activitylog\Contracts\Activity;

activity()
   ->causedBy($userModel)
   ->performedOn($someContentModel)
   ->tap(function(Activity $activity) {
      $activity->my_custom_field = 'my special value';
   })
   ->log('edited');
   
$lastActivity = Activity::all()->last();

$lastActivity->my_custom_field; // returns 'my special value'
```
