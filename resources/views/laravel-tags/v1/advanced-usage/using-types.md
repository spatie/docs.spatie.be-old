---
title: Using tags
---

A tag can have a certain type.

```php
//creating a tag with a certain type
$tag = Tag::create('tag 1, 'my type'):

//a tag is just a regular eloquent model. You can change the type by chaning the `type` property
$tag->type = 'another type';
$tag->save();
```
