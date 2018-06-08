---
title: Making sure events get handled in the right order
---

In a production environment multiple events will start to come in concurrently. A queue is used to guarantee that all events get passed to projectors in the right order. You should make sure that the queue will process only one job at a time. You can set the name of the queue connection in the `queue` key of the `event-projector` config file.

In a local environment, where events have a very low chance of getting fired concurrently, it's probably ok to just use the `sync` driver.

## Handling events immediately

If you want a projector to handle an event immediately, in the same request as the event was fired, you must implement the `Spatie\EventProjector\Projectors\ShouldBeCalledImmediatly` interface. This is an empty interface that merely hints to the `EventProjectionist` the event handling should happen in a non-queued manner. 
