---
title: Determining the Active Items
---

Menu items are required to implement an `isActive` method. `setActive` and `setInactive` are optional, but available on all default item implementations via the `Activatable` trait.

Items can be set active manually:

```php
Menu::new()->add(Link::to('#', 'Active')->setActive());
```

```html
<ul>
    <li class="active">
        <a href="#">Active</a>
    </li>
</ul>
```

If a child item is active, the parent will be considered active too:

```php
Menu::new()->add(
    Menu::new()->add(Link::to('#', 'Active')->setActive())
);
```

```html
<ul>
    <li class="active">
        <ul>
            <li class="active">
                <a href="#">Active</a>
            </li>
        </ul>
    </li>
</ul>
```

