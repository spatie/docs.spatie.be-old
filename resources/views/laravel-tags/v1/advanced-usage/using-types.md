---
title: Using tags
---

In your application you might want to have multiple collections of tags. For example: you might want one group of tags for your `News` model and another group of tags for your `BlogPost` model. 

To create separate collections of tags you can use tag types.

```php
//creating a tag with a certain type
$tagWithType = Tag::create('tag 1, 'news model tag'):
```

In addition to strings, all methods mentioned in the basic usage section can take instances of `Tag` as well.

```php
$newsItem->attachTag($tagWithType);
$newsItem->detachTag($tagWithType);
...
```

The provided method scopes, `withAnyTags` and `withAllTags`, can take