---
title: Adding Raw Html
---

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
Menu::new()->add(
    Html::raw('<span>Hi!</span>')->setActive()
);
```

Since you have full control over the inner html of the item, you can't set attributes via the `HtmlAttributes` trait. You can however add parent attributes.

```php
Menu::new()->add(
    Html::raw('<span>Hi!</span>')
        ->setActive()
        ->addParentClass('foo')
);
```

```html
<ul>
    <li class="active foo">
        <span>Hi!</span>
    </li>
</ul>
```

You can also append and prepend raw html outside of the `ul` tag. This is useful for submenu titles.

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
