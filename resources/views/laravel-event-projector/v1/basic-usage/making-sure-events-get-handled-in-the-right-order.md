---
title: Making sure events get handled in the right order
---

In a production environment multiple events will start to come in concurrently. A queue is used to guarantee that all events get passed to projectors in the right order. You should make sure that the queue will process only one job at a time. You can set the name of the queue connection in the `queue` key of the `event-projector` config file.

In a local environment, where events have a very low chance of getting fired concurrently, it's probably ok to just use the `sync` driver.

## Handling events synchronously

If you want a projector to handle an event immediately, in the same request as the event was fired, you should let your projector implement the `Spatie\EventProjector\Projectors\SyncProjector` interface instead of the the normal `Spatie\EventProjector\Projectors\SyncProjector`. This is interface that hints to the `EventProjectionist` the event handling should happen in a non-queued manner. 

If you have a lot of concurrently requests that fire off events that should be handled synchronously theres a high chance that projectors will fall behind. For a more detailed look at the problem and the solution read the section [on using event streams](/laravel-event-projector/v1/basic-usage/using-event-streams)
