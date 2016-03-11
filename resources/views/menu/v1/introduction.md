---
title: Introduction
---

This **Laravel 5** package creates a menu of your application. The menu is a zipfile that contains all files in the directories you specify along with a dump of your database. The menu can be stored on [any of the filesystems](http://laravel.com/docs/5.0/filesystem)  you have configured in Laravel 5.

Feeling paranoid about menus? Don't be! You can menu your application to multiple filesystems at once.

Once installed, making a menu of your files and databases is very easy. Just issue this artisan command:

``` bash
php artisan menu:run
```

In addition to making the menu the package can also clean up old menus, monitor the health of the menus, and show an overview of all menus.

## We have badges!

<section class="article_badges">
    <a href="https://github.com/spatie/laravel-menu/releases"><img src="https://img.shields.io/github/release/spatie/laravel-menu.svg?style=flat-square" alt="Latest Version"></a>
    <a href="LICENSE.md"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License"></a>
    <a href="https://travis-ci.org/spatie/laravel-menu"><img src="https://img.shields.io/travis/spatie/laravel-menu/master.svg?style=flat-square" alt="Build Status"></a>
    <a href="https://insight.sensiolabs.com/projects/3f243a38-a1c7-42f5-96c8-37526e807029"><img src="https://img.shields.io/sensiolabs/i/3f243a38-a1c7-42f5-96c8-37526e807029.svg?style=flat-square" alt="SensioLabsInsight"></a>
    <a href="https://scrutinizer-ci.com/g/spatie/laravel-menu"><img src="https://img.shields.io/scrutinizer/g/spatie/laravel-menu.svg?style=flat-square" alt="Quality Score"></a>
    <a href="https://packagist.org/packages/spatie/laravel-menu"><img src="https://img.shields.io/packagist/dt/spatie/laravel-menu.svg?style=flat-square" alt="Total Downloads"></a>
</section>
