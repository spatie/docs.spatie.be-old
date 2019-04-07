---
title: Writing your first aggregate
---

An aggregate is a class that decide to record events based on past events. To know more about their general purpose and the idea behind them, read this section on [using aggregates to make decisions-based-on-the-past](https://docs.spatie.be/laravel-event-projector/v2/getting-familiar-with-event-sourcing/using-aggregates-to-make-decisions-based-on-the-past).
 
## Creating an aggregate 
 
The easiest way to create an aggregate root would be to use the `make:aggregate` command:

```php
php artisan make:projector AccountAggregate
```

This will create a class like this:

```php
namespace App\Aggregates;

use Spatie\EventProjector\AggregateRoot;


final class AccountAggregate extends AggregateRoot
{
}
```

Let's 




