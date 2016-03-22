---
title: Adding Items
---

## Links

`Spatie\Menu\Link`

Links are created with the `to` factory method, which accepts a url and a string of text (or html) as parameters. There's also a convenience method on the `Menu` class.

```php
Menu::new()->add(Link::to('/', 'Home'));
```

```php
Menu::new()->link('/', 'Home');
```

```html
<ul>
    <li><a href="/">Home</a></li>
</ul>
```

<div class="alert -info">
When using convenience methods to add items, you can't simultanuously add classes or attributes to the item since there isn't an instance variable.
</div>

Links also have a `prefix` method, or they can be prefixed in bulk per menu.

```php
Link::to('foo', 'Foo')->prefix('/items');
```

```html
<a href="/users/sebastian">Sebastian</a>
```

```php
Menu::new()
    ->prefixLinks('/items')
    ->link('foo', 'Foo')
    ->link('bar', 'Bar');
```

```html
<ul>
    <li><a href="/items/foo">Foo</a></li>
    <li><a href="/items/bar">Bar</a></li>
</ul>
```

## Raw Html

`Spatie\Menu\Html`

Raw html chunks can be added as menu items via the `Html` class or convenience method.

```php
Menu::new()->add(Html::raw('<span>Hi!</span>'));
```

```php
Menu::new()->html('<span>Hi!</span>');
```

```html
<ul>
    <li><span>Hi!</span></li>
</ul>
```

## Submenus

`Spatie\Menu\Menu`

Since the `Menu` class itself implements the `Item` interface, menus can be nested. All you need to do is pass a new `Menu` instance to the `add` function:

```php
Menu::new()
    ->link('/', 'Menu')
    ->add(Menu::new()
        ->link('/basic-usage/your-first-menu', 'Your First Menu')
        ->link('/basic-usage/adding-submenus', 'Adding Submenus')
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

You can also exclusively use submenus to divide your menu in sections.

```php
Menu::new()
    ->add(Menu::new()
        ->link('/introduction', 'Introduction')
        ->link('/requirements', 'Requirements')
        ->link('/installation-setup', 'Installation and Setup')
    )
    ->add(Menu::new()
        ->prepend('<h2>Basic Usage</h2>')
        ->prefixLinks('/basic-usage')
        ->link('/your-first-menu', 'Your First Menu')
        ->link('/working-with-items', 'Working With Items')
        ->link('/adding-sub-menus', 'Adding Sub Menus')
    );
```

```html
<ul>
    <li>
        <ul>
            <li><a href="/introduction">Introduction</a></li>
            <li><a href="/requirements">Requirements</a></li>
            <li><a href="/installation-setup">Installation and Setup</a></li>
        </ul>
    </li>
    <li>
        <h2>Basic Usage</h2>
        <ul>
            <li><a href="/basic-usage/your-first-menu">Your First Menu</a></li>
            <li><a href="/basic-usage/working-with-items">Working With Items</a></li>
            <li><a href="/basic-usage/adding-sub-menus">Adding Sub Menus</a></li>
        </ul>
    </li>
</ul>
```
