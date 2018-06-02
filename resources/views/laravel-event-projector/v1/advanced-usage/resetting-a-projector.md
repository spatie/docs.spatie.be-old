---
title: Resetting a projector
---

When replaying events a projector will only receive events is has not handled yet. If you want to build up the state of a projector again from scratch, you must reset the projector before replaying events. Resetting a projector will remove all state the projector has built up. It's entry in the [`projector_statuses`](TODO: add link) table will be removed.

## Preparing your projector

In order to make your projector resettable you have to add a `resetState` to it. In this method you'll have to perform the work necessary to clean up the state of your projector. When resetting the projector we will call this method. If for instance, your projector is backed by an Eloquent model, you can truncate that model.

```php
namespace App\Projectors;

use Spatie\EventProjector\Projectors\Projector;
use Spatie\EventProjector\Projectors\ProjectsEvents;

class ResettableProjector implements Projector
{
    use ProjectsEvents;

    public function resetState()
    {
        // do the work...
    }
}
```

## Resetting your projector via an artisan command

You can reset a projector by using this artisan command. In this example we are going to reset the `AccountBalanceProjector`:

```bash
php artisan event-projector:reset-projector --projector=App\\Projectors\\AccountBalanceProjector
```

If you have [named your projector](TODO: add link) you can use the projector name instead of the fully qualified class name.

## Resetting your projector via code

You can also reset a projector with code. Here's an example

```php
use Spatie\EventProjector\Facades\EventProjectionist;

//...

$projector = EventProjectionist::getProjector($projectorClassOrName);

$projector->reset();
```
