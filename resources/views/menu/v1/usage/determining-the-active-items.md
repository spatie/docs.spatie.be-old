---
title: Determining the Active Items
---

## Manually Activating Items

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

## Determining the Active Items in Bulk

The `Menu` class also has a `setActive` method, but in this case it's meant to set it's children active based on a string or a callable.

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

