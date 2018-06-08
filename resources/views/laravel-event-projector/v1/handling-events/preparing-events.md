---
title: Preparing events
---

The package will listen for events that implement the `\Spatie\EventProjector\ShouldBeStored` interface. This is an empty interface that simply signals to the package that the event should be stored.

You can quickly create an event that implements `ShouldBeStored` by running this artisan command:

```bash
php artisan make:storable-event NameOfYourEvent
```

Here's an example of such event:

```php
namespace App\Events;

use Spatie\EventProjector\ShouldBeStored;

class MoneyAdded implements ShouldBeStored
{
    /** @var int */
    public $accountId;

    /** @var int */
    public $amount;

    public function __construct(int $accountId, int $amount)
    {
        $this->accountId = $accountId;

        $this->amount = $amount;
    }
}
```

Whenever an event that implements `ShouldBeStored` is fired it will be serialized and written in the `stored_events` table. Immediately after that, the event will be passed to all projectors and reactors.

If your event has an eloquent model, it should also use the `Illuminate\Queue\SerializesModels` trait so we are able to serialize these models correctly.
