---
title: Writing your first reactor
---

## What is a reactor

Now that you've [written your first projector](/laravel-event-projector/v2/using-projectors/writing-your-first-projector), let's learn how to handle side effects. With side effects we mean things like sending a mail, sending a notification, ... You only want to perform these actions when the original event happens. You don't want to do this work when replaying events.

A reactor is a class, that much like a projector, listens for incoming events. Unlike projectors however, reactors will not get called when events are replayed. Reactors only will get called when the original event fires.

## Creating your first reactor

Let's create your first reactor. You can perform `php artisan make:reactor BigAmountAddedReactor` to create a reactor in `app\Reactors`. We will make this reactor send a mail to the director of the bank whenever a big amount of money is added to an account. Typehinting `MoneyAdded` will make our package call `onMoneyAdded` when the event occurs.

```php
namespace App\Reactors;

use App\Account;
use App\Events\MoneyAdded;
use App\Mail\BigAmountAddedMail;
use Illuminate\Support\Facades\Mail;

class BigAmountAddedReactor
{
    public function onMoneyAdded(MoneyAdded $event)
    {
        if ($event->amount < 900) {
            return;
        }

        $account = Account::uuid($event->accountUuid);

        Mail::to('director@bank.com')->send(new BigAmountAddedMail($account, $event->amount));
    }
}
```

By default the package will automatically find and use your reactor.

## Using the reactor

The reactor above will send an email to the director of the bank whenever an amount of 900 or more gets added to an account. Let's put the reactor to work.

```php
$account = Account::createWithAttributes(['name' => 'Rey']);
$account->addMoney(1000);
```

A mail will be sent to the director.

If you truncate the `accounts` table and rebuild the contents with

```php
php artisan event-projector:rebuild
```

no mail will be sent.
