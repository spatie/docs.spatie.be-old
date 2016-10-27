---
title: Retrieving tagged models
---

The package provides two scopes `withAnyTags` and `withAllTags` that can help you find models with certain tags.

```php
// returns models that have one or more of the given tags
YourModel::withAnyTags(['tag 1', 'tag 2'])->get();

// returns models that have all given tags
YourModel::withAllTags(['tag 1', 'tag 2'])->get();
```
