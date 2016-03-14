---
title: Adding Sub Menus
---

Since the `Menu` class itself implements the `Item` interface, menu's can be nested.

```php
Menu::new()
    ->add(Link::to('/', 'Menu'))
    ->add(Menu::new()
        ->add(Link::to('/basic-usage/your-first-menu', 'Your First Menu'))
        ->add(Link::to('/basic-usage/adding-sub-menus', 'Adding Sub Menus'))
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
                <a href="/basic-usage/adding-sub-menus">
                    Adding Sub Menus
                </a>
            </li>
        </ul>
    </li>
</ul>
```

