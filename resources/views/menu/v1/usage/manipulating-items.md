---
title: Manipulating Items
---

There are three methods to manipulate items in a menu:

- `each`: Goes over all existing items and applies a manipulation
- `registerFilter`: Registers a manipulation that will be applied to all items added afterwards
- `applyToAll`: Applies a manipulation to all existing and all future items

All methods require a `callable` as their first and only parameter. The callable will receive the item as it's parameter. If this parameter is typehinted, the manipulation will only be applied to items of that type.

```php
Menu::new()
    ->add(Link::to('/', 'Home'))
    ->add(Html::raw('<a href="#" data-avatar>Profile</a>'))
    ->each(function (Link $link) {
        $link->addClass('link');
    })
    ->each(function (Html $html) {
        $html->addClass('html');
    });
```

In the above example, all links will recieve a `link` class, and all html chunks will receive an `html` class.

## `each(callable $callable)`

Iterates over all existing items, and applies a manipulation. If the result of the callable is `false` (strict), the item will be removed from the menu.

```php
Menu::new()
    ->add(Link::to('/foo-before', 'Foo before'))
    ->add(Link::to('/bar-before', 'Bar before'))
    ->each(function (Link $link) {

        // Return false if string doesn't contain 'Foo'
        if (strpos($link->getText(), 'Foo') === false) {
            return false;
        }

        $link->addClass('-has-foo');
    })
    ->add(Link::to('/foo-after', 'Foo after'))
    ->add(Link::to('/bar-after', 'Bar after'))
```

```html
<ul>
    <li><a href="/foo-before" class="-has-foo">Foo before</a></li>
    <li><a href="/foo-after">Foo after</a></li>
    <li><a href="/bar-after">Bar after</a></li>
</ul>
```

## `registerFilter(callable $callable)`

Registers a manipulation that will be applied on every new item. If the result of the callable is `false` (strict), the item won't be added to the menu.

```php
Menu::new()
    ->add(Link::to('/foo-before', 'Foo before'))
    ->add(Link::to('/bar-before', 'Bar before'))
    ->registerFilter(function (Link $link) {

        // Return false if string doesn't contain 'Foo'
        if (strpos($link->getText(), 'Foo') === false) {
            return false;
        }

        $link->addClass('-has-foo');
    })
    ->add(Link::to('/foo-after', 'Foo after'))
    ->add(Link::to('/bar-after', 'Bar after'))
```

```html
<ul>
    <li><a href="/foo-before">Foo before</a></li>
    <li><a href="/bar-before">Bar before</a></li>
    <li><a href="/foo-after" class="-has-foo">Foo after</a></li>
</ul>
```

## `applyToAll(callable $callable)`

Applies a manipulation to all existing and future items (does a call to both `each` and `registerFilter` under the hood).

```php
Menu::new()
    ->add(Link::to('/foo-before', 'Foo before'))
    ->add(Link::to('/bar-before', 'Bar before'))
    ->applyToAll(function (Link $link) {

        // Return false if string doesn't contain 'Foo'
        if (strpos($link->getText(), 'Foo') === false) {
            return false;
        }

        $link->addClass('-has-foo');
    })
    ->add(Link::to('/foo-after', 'Foo after'))
    ->add(Link::to('/bar-after', 'Bar after'))
```

```html
<ul>
    <li><a href="/foo-before" class="-has-foo">Foo before</a></li>
    <li><a href="/foo-after" class="-has-foo">Foo after</a></li>
</ul>
```
