---
title: Determining the Active Items
---

## Manually Activating Items

All items have an `isActive`, `setActive` and `setInactive` method. The last two allow you to manually determine whether an item is active or not (by default all items are inactive).

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
    Menu::new()
        ->add(Html::raw('<a href="#"><img src="/avatar.jpg"></a>')->setActive())
);
```

```html
<ul>
    <li class="active">
        <ul>
            <li class="active">
                <a href="#"><img src="/avatar.jpg"></a>
            </li>
        </ul>
    </li>
</ul>
```

## Automatically Determining the Active Items

The `Menu` class also has a `setActive` method, but it behaves differently than the method on `Link` and `Html`. It accepts a url or a callable as it's parameter, and will use that to determine which underlying items are active.

### Determining the Active Items With a Url


<div class="alert -info">
Html elements will never be set active this way since they don't have a dedicated url property
</div>

### Determining the Active Items With a Callable

```php
$menu = Menu::new()
    ->add(Link::to('/', 'Home'))
    ->add(Link::to('/about', 'About'))
    ->add(Link::to('/contact', 'Contact'));

// With a pattern:
$menu->setActive('^/about');

// With a callable:
$menu->setActive(function (Link $link) {
    return $link->segment(1) === 'about';
});
```

```html
<ul>
    <li><a href="/">Home</a></li>
    <li class="active"><a href="/about">About</a></li>
    <li><a href="/contact">Contact</a></li>
</ul>
```
