---
title: Writing your first projector
---

In this section you'll learn how to write a projector. A projector is simply a class that does some work when it hears some events come in. Typically it writes data (to the database or to a file on disk). We call that written data a projection.

Imagine you are a bank with customers that have accounts. All these accounts have a balance. When money gets added or subtracted we could modify the balance. If we do that however, we would never know why the balance got to that number. If we were to store all the events we could calculate the balance. 

## Creating a model

Here's a small migration to create a table that holds accounts:

```php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('balance')->default(0);
            $table->timestamps();
        });
    }
}
```

The `Account` model itself could look like this:

```php
use App\Events\AccountCreated;
use App\Events\AccountDeleted;
use App\Events\MoneyAdded;
use App\Events\MoneySubtracted;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $guarded = [];

    public static function createWithAttributes(array $attributes)
    {
        event(new AccountCreated($attributes));
    }

    public function addMoney(int $amount)
    {
        event(new MoneyAdded($this->id, $amount));
        
        return $this;
    }

    public function subtractMoney(int $amount)
    {
        event(new MoneySubtracted($this->id, $amount));
        
        return $this;
    }

    public function close()
    {
        event(new AccountDeleted($this->id));
    }
}
```

## Defining events

Instead of calculating the balance we're simply firing off events. All these events should implement `\Spatie\EventProjector\ShouldBeStored`. This is an empty interface that signifies to our package that the event should be stored.

Let's take a look at all events used in the `Account` model.

```php
namespace App\Events;

class AccountCreated implements ShouldBeStored
{
    /** @var array */
    public $accountAttributes;

    public function __construct(array $accountAttributes)
    {
        $this->accountAttributes = $accountAttributes;
    }
}
```

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

```php
namespace App\Events;

use Spatie\EventProjector\ShouldBeStored;

class MoneySubtracted implements ShouldBeStored
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

```php
namespace App\Events;

use Spatie\EventProjector\ShouldBeStored;

class AccountDeleted implements ShouldBeStored
{
    /** @var int */
    public $accountId;

    public function __construct(int $accountId)
    {
        $this->accountId = $accountId;
    }
}
```

## Creating your first projector

A projector is a class that listens for events that were stored. When it hears an event that it is interested in, it can perform some work.

Let's create your first projector. You can perform `php artisan make:projector AccountBalanceProjector` to create a projector in `app\Projectors`.

Here's an example projector that handles all the events mentioned above:

```php
namespace App\Projectors;

use App\Account;
use App\Events\AccountCreated;
use App\Events\AccountDeleted;
use App\Events\MoneyAdded;
use Spatie\EventProjector\Projectors\Projector;
use Spatie\EventProjector\Projectors\ProjectsEvents;

class AccountBalanceProjector implements Projector
{
    use ProjectsEvents;
    
    /*
     * Here you can specify which event should trigger which method.
     */
    public $handlesEvents = [
        AccountCreated::class => 'onAccountCreated',
        MoneyAdded::class => 'onMoneyAdded',
        MoneySubtracted::class => 'onMoneySubtracted',
        AccountDeleted::class => 'onAccountDeleted',
    ];

    public function onAccountCreated(AccountCreated $event)
    {
        Account::create($event->accountAttributes);
    }

    public function onMoneyAdded(MoneyAdded $event)
    {
        $account = Account::find($event->accountId);

        $account->balance += $event->amount;

        $account->save();
    }

    public function onMoneySubtracted(MoneyAdded $event)
    {
        $account = Account::find($event->accountId);

        $account->balance -= $event->amount;

        $account->save();
    }

    public function onAccountDeleted(AccountDeleted $event)
    {
        Account::find($event->accountId)->delete();
    }
}
```

## Registering your projector

The projector code up above will handle all the work that needs to be done for the given events. For the package to be able to locate this projector you should register it. The easiest way to register a projector is by calling `addProjector` on the `EventProjectionist` facade. Typically you would put this in a service provider of your own.

```php
use \Spatie\EventProjector\Facades\EventProjectionist;
use \App\Projectors\AccountBalanceProjector;

...

EventProjectionist::addProjector(AccountBalanceProjector::class)
```

## Let's fire off some events

With all this out of the way we can fire off some events.

Let's try adding an account with:

```php
$account = Account::createWithAttributes(['name' => 'Luke']);
$anotherAccount = Account::createWithAttributes(['name' => 'Leia']);
```

And let's make some transactions on that account:

```php
// do stuff like this

$account->addMoney(1000);
$anotherAccount->addMoney(500);
$account->subtractMoney(50);

...
```

If you take a look at the contents of the `accounts` table you should see some accounts together with their calculated balance. Sweet! In the `stored_events` you should see an entry per event that we fired. 

## Your second projector

Imagine that after a while someone at the bank wants to know which accounts have processed the most transactions. Because we stored all changes to the accounts in the events table we can easily get that info by creating another projector. 

We are going to create another projector that stores the transaction count per account in a model. Bear in mind that you can easily use any other storage mechansim instead of a model. The projector doesn't care what you use.

Here's the migration and the model class that the projector is going to use:

```php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionCountsTable extends Migration
{
    public function up()
    {
        Schema::create('transaction_counts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id');
            $table->integer('count')->default(0);
            $table->timestamps();
        });
    }
}
```

```php
namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionCount extends Model
{
    public $guarded = [];
}
```

And here's the projector that is going to listen to the `MoneyAdded` and `MoneySubtracted` events

```php
namespace App\Projectors;

use App\Events\MoneyAdded;
use App\Events\MoneySubtracted;
use App\TransactionCount;
use Spatie\EventProjector\Projectors\Projector;
use Spatie\EventProjector\Projectors\ProjectsEvents;

class TransactionCountProjector implements Projector
{
    use ProjectsEvents;

    public $handlesEvents = [
        MoneyAdded::class => 'onMoneyAdded',
        MoneySubtracted::class => 'onMoneySubtracted',
    ];

    public function onMoneyAdded(MoneyAdded $event)
    {
        $transactionCounter = TransactionCount::firstOrCreate(['account_id' => $event->accountId]);

        $transactionCounter->count +=1;

        $transactionCounter->save();
    }

    public function onMoneySubtracted(MoneySubtracted $event)
    {
        $transactionCounter = TransactionCount::firstOrCreate(['account_id' => $event->accountId]);

        $transactionCounter->count -=1;

        $transactionCounter->save();
    }
}
```

Let's not forget to register this projector:

```php
// in a service provider of your own
EventProjectionist::addProjector(TransactionCountProjector::class)
```

If you've followed along you've already created some accounts and some events. To feed those past events to the projector we can simply perform this artisan command:

```php
php artisan event-projector:replay-events
```

This command will take all events stored in the `stored_events` table and pass them to  `TransactionCountProjector`. After the command completes you should see the transaction counts in the `transaction_counts` table.

## Welcoming new events

Now that both of your projections have handled all events, try firing off some new events.

```
$yetAnotherAccount = Account::createWithAttributes(['name' => 'Yoda']);
```

And let's add some transactions to that account:

```php
// do stuff like this

$yetAnotherAccount->addMoney(1000);
$yetAnotherAccount->subtractMoney(50);
```

You'll notice that both projectors are doing their jobs. The balance of the `Account` model is up to date and the data in the `transaction_counts` table gets updated.

## Benefits of projectors and projections

The cool thing of projectors is that you can write them after events have happened. Image that someone at the bank wants to have a report of the average balance of each account. You would be able to write a new projector, replay all events and have that data.

Projections are very fast to query. Image that our application has processed millions of events. If you want to create a screen where you display the accounts with the most transactions you can easily query the `transaction_counts` table. This way you don't need to fire off some expensive query. The projector will keep the projections (the `transaction_counts` table) up to date.

