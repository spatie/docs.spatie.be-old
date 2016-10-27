---
title: Adding translations
---

The tag model is translatable. Behind the scenes [spatie/laravel-translatable](https://github.com/spatie/laravel-translatable) is used. You can use any method provided by that package.

```php
$tag = Tag::findOrCreate('my tag');

$tag->setTranslation('name', 'fr', 'mon tag');
$tag->setTranslation('name', 'nl', 'mijn tag');

$tag->save();

$tag->getTranslation('fr') // returns 'mon tag'
```

