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

You can add any methods or variables you need on the aggregate. To get you familiar with event modelling using aggregates let's implement a small piece of [the Larabank example app](https://github.com/spatie/larabank-event-projector-aggregates). We are going to add methods to record the [`AccountCreated`](https://github.com/spatie/larabank-event-projector-aggregates/blob/c9f2ff240f4634ee2e241e3087ff60587a176ae0/app/Domain/Account/DomainEvents/AccountCreated.php) and the [`MoneySubtracted`](https://github.com/spatie/larabank-event-projector-aggregates/blob/c9f2ff240f4634ee2e241e3087ff60587a176ae0/app/Domain/Account/DomainEvents/MoneySubtracted.php) events.

First let's add a `createAccount` methods to our aggregate that will record the `AccountCreated` event.

```php
namespace App\Aggregates;

use Spatie\EventProjector\AggregateRoot;


final class AccountAggregate extends AggregateRoot
{
    public function createAccount(string $name, string $userId)
    {
        $this->recordThat(new AccountCreated($name, $userId));
    }
    
    public function subtractAmount(int $amount)
    {
        $this->recordThat(new MoneySubtracted($amount));
    }
   
}
```

The `recordThat` function will not persist the events to the database. It will simply hold them in memory. The events will get written to the database when the aggregate itself is persisted.

There are two things to notice. First, the method name is writting in the present tense, not the past tense. We're trying to do something, and for the rest of our application is hasn't happend yet until the actual `AccountCreated` is saved. This will only happen when the `AccountAggregate` gets persisted.

The second thing to note is that nor the method and the event contain an uuid. The aggregate itself is aware of the uuid to use because it is passed to the retrieve method (`AccountAggregate::retrieve($uuid)`, we'll get to this in a bit). When persisting the aggregateroot, it will save the record events along with the uuid.

With this in place you can use the aggregate like this:

```php
AccountAggregate::retrieve($uuid)
    ->createAccount('my account', auth()->user()->id)
    ->persist();
```

```php
AccountAggregate::retrieve($uuid)
    ->subtractMoney(123)
    ->persist();
```

When persisting an aggregate all newly recorded events inside aggregate root will be saved to the database. The newly recorded events will also get passed to all projectors and reactors that listen for them.




