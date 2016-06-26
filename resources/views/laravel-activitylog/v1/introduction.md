---
title: Introduction
---

The `spatie/laravel-activity` package provides easy to use functions to log the activities of the users of your app. All activity will be stored in the `activity_log` table. 

Here's a litte demo of how you can use it:

```php
activity()->log('Look mum, I logged something');
```

You can retrieve all activity using the `Spatie\Activitylog\Models\Activity` model.

```php
Activity::all(); // returns all activity
```

## We have badges!

<section class="article_badges">
    <a href="https://packagist.org/packages/spatie/laravel-activitylog"><img src="https://img.shields.io/badge/packagist-spatie/laravel-activitylog-orange.svg?style=flat-square" alt="spatie/laravel-activitylog"></a>
    <a href="https://packagist.org/packages/spatie/laravel-activitylog"><img src="https://img.shields.io/packagist/v/spatie/laravel-activitylog.svg?style=flat-square" alt="Latest Version on Packagist"></a>
    <a href="LICENSE.md"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License"></a>
    <a href="https://travis-ci.org/spatie/laravel-activitylog"><img src="https://img.shields.io/travis/spatie/laravel-activitylog/master.svg?style=flat-square" alt="Build Status"></a>
    <a href="https://insight.sensiolabs.com/projects/20a38dd4-06a0-401f-bd51-1d3f05fcdff5"><img src="https://img.shields.io/sensiolabs/i/20a38dd4-06a0-401f-bd51-1d3f05fcdff5.svg?style=flat-square" alt="SensioLabsInsight"></a>
    <a href="https://scrutinizer-ci.com/g/spatie/laravel-activitylog"><img src="https://img.shields.io/scrutinizer/g/spatie/laravel-activitylog.svg?style=flat-square" alt="Quality Score"></a>
    <a href="https://packagist.org/packages/spatie/laravel-activitylog"><img src="https://img.shields.io/packagist/dt/spatie/laravel-activitylog.svg?style=flat-square" alt="Total Downloads"></a>
</section>
