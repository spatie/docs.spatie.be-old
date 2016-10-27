---
title: Introduction
---

This package provides you with a `HasTags` trait with which you can easily add tags to your Eloquent models. Once the package is set up you can do stuff like this:

```php
// create a model with some tags
$newsItem = NewsItem::create([
   'name' => 'testModel',
   'tags' => ['tag', 'tag2'], //tags will be created if they don't exist
]);

//attaching tags
$newsItem->attachTag('tag3');
$newsItem->attachTags(['tag4', 'tag5']);

//detaching tags
$newsItem->detachTags('tag3');
$newsItem->detachTags(['tag4', 'tag5']);

//syncing tags
$newsItem->syncTags(['tag1', 'tag2');

//retrieve models that have any of the given tags
NewsItem::withAnyTags(['tag1', 'tag2']);

//retrieve models that have all of the given tags
NewsItem::withAllTags(['tag1', 'tag2']);
```

This is the core functionality of almost every other tag package out there. What makes this spatie/laravel-tags unique is the built in support for translations, tag types, slugs, and sortable tags.

```php
//attaching a tag with a type
NewsItem::attachTag(Tag::findOrCreate('string', 'myType'));

// the tag model has a scope to retrieve all tags with a certain type
Tag::type('myType')->get()

// tags can hold translations
$tag = Tag::findOrCreate('my tag'); //uses the app's locale
$tag->setTranslation('fr', 'mon tag');
$tag->setTranslation('nl', 'mijn tag');
$tag->save();

// tags are sortable
$tag = Tag::findOrCreate('my tag');
$tag->order_column //returns 1
$tag2 = Tag::findOrCreate('another tag');
$tag2->order_column //returns 2

// tags have slugs 

```

## We have badges!

<section class="article_badges">
    <a href="https://packagist.org/packages/spatie/laravel-tags"><img src="https://img.shields.io/packagist/v/spatie/laravel-tags.svg?style=flat-square" alt="Latest Version on Packagist"></a>
    <a href="LICENSE.md"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License"></a>
    <a href="https://travis-ci.org/spatie/laravel-tags"><img src="https://img.shields.io/travis/spatie/laravel-tags/master.svg?style=flat-square" alt="Build Status"></a>
    <a href="https://insight.sensiolabs.com/projects/b9e28680-fffe-4e6f-90fa-8c83417f6a86"><img src="https://img.shields.io/sensiolabs/i/b9e28680-fffe-4e6f-90fa-8c83417f6a86.svg?style=flat-square" alt="SensioLabsInsight"></a>
    <a href="https://scrutinizer-ci.com/g/spatie/laravel-tags"><img src="https://img.shields.io/scrutinizer/g/spatie/laravel-tags.svg?style=flat-square" alt="Quality Score"></a>
    <a href="https://packagist.org/packages/spatie/laravel-tags"><img src="https://img.shields.io/packagist/dt/spatie/laravel-tags.svg?style=flat-square" alt="Total Downloads"></a>
</section>
