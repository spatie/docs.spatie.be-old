---
title: Storing metadata
---

You can add metadata, such as the id of the logged-in user, to a stored event. The `StoredEvent` instance will be passed on to any projector method that has a variable named `$storedEvent`. On that `StoredEvent` instance there is a property, `meta_data`, that returns an instance of `Spatie\SchemalessAttributes\SchemalessAttributes`.

Here's an example:

```php
namespace App\Projectors;

use Spatie\EventProjector\Projectors\Projector;
use Spatie\EventProjector\Projectors\ProjectsEvents;

class MetaDataProjector implements Projector
{
    use ProjectsEvents;

    /*
     * Here you can specify which event should trigger which method.
     */
    public $handlesEvents = [
        '*' => 'onAnyEvent',
    ];

    public function onAnyEvent(StoredEvent $storedEvent)
    {
        $storedEvent->meta_data->user_id = auth()->user()->id;

        $storedEvent->save();
    }
}
```
