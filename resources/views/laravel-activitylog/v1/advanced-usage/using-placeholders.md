---
title: Using placeholders
---

When logging an activity you may use placholders that start with `:subject`, `:causer` or `:properties`. These place holders will get replaced with the properties of the given subject, causer or property.

Here's an example:

```php
activity()
    ->performedOn($article)
    ->causedBy($user)
    ->withProperties(['laravel' => 'awesome'])
    ->log('The subject name is :subject.name, the causer name is :causer.name and Laravel is :properties.laravel');

$lastActivity = Activity::all()->last();
$lastActivity->description; //returns 'Subject name is article name, causer name is user name and property key is value and sub key subvalue';
```
