---
title: Using your own event storage model
---

The default model responsable for storing events is `\Spatie\EventProjector\Models\StoredEvent`. If you want to add behaviour to that model you can create a class of your own that extends the `StoredEvent` model. You should but the class name of your model in the `stored_event_model` in the `event-projector.php` config file.