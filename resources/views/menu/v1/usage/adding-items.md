---
title: Adding Items
---

In [Your First Menu](/menu/v1/usage/your-first-menu) we already covered links. The menu package ships with two other `Item` implementations, one for raw html and one for submenus.

## Raw Html

Raw html chunks can be added as menu items via the `Html` class.

```php
Menu::new()->add(Html::raw('<span>Hi!</span>'));
```

```html
<ul>
    <li>
        <span>Hi!</span>
    </li>
</ul>
```

Html elements can be set active, but this will have to be done manually since they don't have a dedicated url property.

```php
Menu::new()
    ->add(
        Html::raw('<span>Hi!</span>')->setActive()
    );
```

## Submenus

Since the `Menu` class itself implements the `Item` interface, menu's can be nested. All you need to do is pass a new `Menu` instance to the `add` function:

```php
Menu::new()
    ->add(Link::to('/', 'Menu'))
    ->add(Menu::new()
        ->add(Link::to('/basic-usage/your-first-menu', 'Your First Menu'))
        ->add(Link::to('/basic-usage/adding-submenus', 'Adding Submenus'))
    );
```

```html
<ul>
    <li>
        <a href="/">Menu</a>
    </li>
    <li>
        <ul>
            <li>
                <a href="/basic-usage/your-first-menu">
                    Your First Menu
                </a>
            </li>
            <li>
                <a href="/basic-usage/adding-submenus">
                    Adding Submenus
                </a>
            </li>
        </ul>
    </li>
</ul>
```

