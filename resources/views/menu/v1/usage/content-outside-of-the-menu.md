---
title: Content Outside of the Menu
---

You can append and prepend html outside of the `ul` tag with similarly named functions. This is useful for submenu titles or separators.

```php
Menu::new()
    ->prepend('<h2>Title</h2>')
    ->add(Link::to('/title/subpage', 'Subpage'))
    ->append('<hr>');
```

```html
<h2>Title</h2>
<ul>
    <li>
        <a href="/title/subpage">Subpage</a>
    </li>
</ul>
<hr>
```
