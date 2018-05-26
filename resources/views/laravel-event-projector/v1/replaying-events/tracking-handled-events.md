---
title: Tracking handled events
---

The package keeps track of which events were already passed to which projectors. When replaying events it will never pass an event to a projector that already handled it. 

The `projector_statuses` table contains info on what is the status of each projector. It contains these fields:

- `name`: The fully qualified class name of your projector
- `last_processed_event_id`: The id of the last event that was handled by this projector

## Listing projector statuses

You can list all projectors and their status with this artisan command:

```bash
php artisan event-projector:list
```

Here's some example output:
![output of list command](/images/event-projector/list-command.png)

The `Up to date` column will contain a green checkmark if the last processed it of that projector is equal the latest (and greatest) id in the `stored_events` table.

## When to replay events

We'll only pass an event to a projector if its `id` is equal to the `last_processed_event_id` of that projector + 1. If the event id is lower than that we will not the pass the event to the projector.  When this happens we'll also fire the `Spatie\EventProjector\EventsProjectorDidNotHandlePriorEvents` event. It contains two public properties:

- `$projector`: an instance of `Spatie\EventProjector\Projectors\Projector`
- `$storedEvent`: an instance of `\Spatie\EventProjector\Models\StoredEvent`. You can get to the event that was fired like this `$storedEvent->event`
 
 To get a projector back up to date you should [replay events](/laravel-event-projector/v1/replaying-events/replaying-events).



