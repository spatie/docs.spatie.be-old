---
title: Dealing With Html Attributes
---

The `Menu` and `Link` classes use the `HtmlAttributes` trait, which enables you to add attributes to their main elements. These are respectively the `ul` and `a` tags.

The trait provides two methods to set attributes: `setAttribute` and `addClass`.

```php
Menu::new()
    ->setAttribute('role', 'navigation')
    ->addClass('nav');
```

```html
<ul role="navigation" class="nav"></ul>
```

The `setAttribute` and `addClass` methods are smart enough to merge class names on render. The latter can also accept an array instead of a string.

```php
Link::to('#', 'Back to top')
    ->setAttribute('class', 'link')
    ->addClass(['button', 'top']);
```

```html
<a href="#" class="link button top">Back to top</a>
```

The `Menu` and `Link`, and `Html` classes also use the `ParentAttributes` trait, which enables you to add attributes to their parent elements.

```php
Menu::new()
    ->add(Html::raw('<img src="/my-avatar">')
        ->setParentAttribute('id', 'user-123')
        ->addParentClass('-has-avatar')
    );
```

```html
<ul>
    <li id="user-123" class="-has-avatar">
        <img src="/my-avatar">
    </li>
</ul>
```

These attributes will only be rendered if the elements are rendered inside of a perent (e.g. a link or a sub menu).