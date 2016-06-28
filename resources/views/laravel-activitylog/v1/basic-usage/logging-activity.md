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
$lastActivity = Activity::all()->last; // returns the last logged activity

$lastActivity->description // returns 'Look mum, I logged something';
```

## Setting a subject

You can specify on which object the activity is performed by using `performedOn`:

```php
activity()
   ->performedOn($someContentModel)
   ->log('edited');

$lastActivity = Activity::all()->last; // returns the last logged activity

$lastActivity->subject // returns the model that was passed to `performedOn`;
```

The `performedOn` has a shorter named alias: `on`

## Setting a causer

You can set who or what caused the activity by using `causedBy`:

```php
activity()
   ->causedBy($userModel)
   ->performedOn($someContentModel)
   ->log('edited');
   
$lastActivity = Activity::all()->last; // returns the last logged activity

$lastActivity->causer // returns the model that was passed to `causedBy`;   
```

The `causedBy` has a shorter named alias: `by`

If you're not using `causedBy` the package will automatically use the logged in user.

## Setting custom properties

You can add any property you want to an activity by using `withProperties`

```php
activity()
   ->causedBy($userModel)
   ->performedOn($someContentModel)
   ->withProperties(['key' => 'value'])
   ->log('edited');
   
$lastActivity = Activity::all()->last; // returns the last logged activity
   
$lastActivity->getExtraProperty('key') // returns 'value';  
```