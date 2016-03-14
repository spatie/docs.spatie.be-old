---
title: Adding Submenus
---

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

