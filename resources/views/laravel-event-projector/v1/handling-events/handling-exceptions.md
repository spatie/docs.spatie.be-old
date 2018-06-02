---
title: Handling exceptions
---

Should a projector or reactor throw an exception the other projectors and reactors will still get called. The `EventProjectionist` will catch all exceptions and fire the `EventHandlerFailedHandlingEvent`. That event contains these public properties:

- `eventHandler`: the projector or reactor that could not handle the event
- `storedEvent`: the instance of `Spatie\EventProjector\Models\StoredEvent` that could not be handled.
- `exception`: the exception thrown by the eventHandler


It will also call the `handleException` method on the projector or reactor that threw the exception. It will receive the thrown error as the first argument. If you throw an exception in `handleException` the `EventProjectionist` will not catch it and your php process will fail.

## Getting projectors up to date again

The `EventProjectionist` [keeps track](https://docs.spatie.be/laravel-event-projector/v1/replaying-events/tracking-handled-events) of which events are handled by which projectors. If a projector throws an exception the `EventHandler` will concluded that the given event was not handled.

Because the projector is not up to date anymore new events for this projector will not be passed to it. To get your projector back up to date you should, after you've fixed the cause of the exception, [replay events](https://docs.spatie.be/laravel-event-projector/v1/replaying-events/replaying-events).