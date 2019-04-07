---
title: Using projectors to transform events
---

Let's build a bit further on the [Larabank example](https://github.com/spatie/larabank-traditional) mentioned in [the previous section](https://docs.spatie.be/laravel-event-projector/v2/getting-familiar-with-event-sourcing/the-traditional-application). The main drawback highlighted that example is the fact that when updating a value, we lose the old value. Let's solve that problem.

Instead of directly updating the value in the database, we could write every change we want to make as an event in our database.

Here we write our first event in the database
**TODO: add an image of event app writing event 1**

When new events come in, we'll write them to the events table as well
**TODO: add an image of event app writing event 1,2,3**

All events get passed to a class we call a projector. The projector transforms the events to a format that is handy to use in our app. In our Larabank example, the events table hold the info of the individual transactions like `MoneyAdded` and `MoneySubtracted`. A projector could build an `Accounts` table based on those transactions.

**TOD0: add an image of event app with one projector (CONSUMER should be renamed PROJECTOR, change table names)**

Imagine that you've already stored some events, and your first projector is doing its job creating that `Accounts` table. The bank directory now wants to know on which accounts the most transactions were performed. No problem, we could create another projector that reads all previous events and acts the `MoneyAdded` and `MoneySubtracted` to make projections.

**TODO: add an image of event app with two projectors (CONSUMER should be renamed PROJECTOR, change table names)**

This package can help you store native Laravel events in a `stored_events` table and create projectors that transform those events. 

Here's our example app [Larabank rebuild with projectors](https://github.com/spatie/larabank-event-projector). In [the `AccountsController`](https://github.com/spatie/larabank-event-projector/blob/d02fd1de7f31f4b915c05df79d9ba61440f9e6b5/app/Http/Controllers/AccountsController.php#L20-L36) we're not going to directly modify the database anymore. Instead, the controller will call methods than in [their turn fire off events](https://github.com/spatie/larabank-event-projector/blob/master/app/Account.php#L15-L42). Our package will listen for those events (which implement the empty `DomainEvent` interface) and store them in the `stored_events` table. Those events will also get passed to [all registered projectors](https://github.com/spatie/larabank-event-projector/blob/d02fd1de7f31f4b915c05df79d9ba61440f9e6b5/config/event-projector.php#L14). In the [`AccountsProjector`](https://github.com/spatie/larabank-event-projector/blob/d02fd1de7f31f4b915c05df79d9ba61440f9e6b5/app/Projectors/AccountsProjector.php) will build the `Accounts` table using [a couple of events it listens for](https://github.com/spatie/larabank-event-projector/blob/d02fd1de7f31f4b915c05df79d9ba61440f9e6b5/app/Projectors/AccountsProjector.php#L17-L22).

If you want to know more about projectors and how to use them, head over to [the `using-projectors` section](https://docs.spatie.be/laravel-event-projector/v2/using-projectors/writing-your-first-projector).
