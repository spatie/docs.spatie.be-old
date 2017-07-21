---
title: Soft Deleting
---

From version 5.13.0 we support models with [Soft Deleting](https://laravel.com/docs/eloquent#soft-deleting), thanks to [Roy Duineveld](https://royduineveld.nl). It's working pretty straight forward; when you soft delete a model with `$model->delete()` the media will not be removed. When you force delete a model with `$model->forceDelete()` the media will be removed.
