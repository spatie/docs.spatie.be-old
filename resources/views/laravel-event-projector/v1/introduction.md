---
title: Introduction
---

Event sourcing is to data what Git is to code. Most applications have their current state stored in a database. By storing only the current state a lot of information is lost. You don't know how the application got in this state.

Event sourcing tries to solve that problem by saving all events that happen in your app. The state of your application is built by listening to those events. 

Here's a traditional example to make it more clear. Imagine you're a bank. Your clients have accounts. Instead of storing the balance of the accounts, you could store all the transactions. That way you not only know the balance of the account but also the reason why it's that specific number. There are many other benefits of storing events.

This package aims to be the simple and very pragmatic way to get started with event sourcing in Laravel.

## We have badges!

<section class="article_badges">
    <a href="https://github.com/spatie/laravel-event-projector/releases"><img src="https://img.shields.io/github/release/spatie/laravel-event-projector.svg?style=flat-square" alt="Latest Version"></a>
    <a href="https://github.com/spatie/laravel-event-projector/blob/master/LICENSE.md"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License"></a>
    <a href="https://travis-ci.org/spatie/laravel-event-projector"><img src="https://img.shields.io/travis/spatie/laravel-event-projector/master.svg?style=flat-square" alt="Build Status"></a>
    <a href="https://scrutinizer-ci.com/g/spatie/laravel-event-projector"><img src="https://img.shields.io/scrutinizer/g/spatie/laravel-event-projector.svg?style=flat-square" alt="Quality Score"></a>
    <a href="https://packagist.org/packages/spatie/laravel-event-projector"><img src="https://img.shields.io/packagist/dt/spatie/laravel-event-projector.svg?style=flat-square" alt="Total Downloads"></a>
</section>
