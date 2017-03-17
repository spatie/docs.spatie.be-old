---
title: Core concepts
---

## `Element` classes

This package contains several element classes under the `Spatie\Html\Elements` namespace. It's possible to generate any HTML element with any attribute via these classes and the [fluent element methods](/html/v1/general-usage/element-methods).

`Element` classes on their own don't have any knowledge of the outside world. That's where the `Spatie\Html\Html` builder comes into play.

## `Html` Builder class

The `Spatie\Html\Html` builder is used to build proper HTML using its [builder methods](/html/v1/general-usage/html-builder). It will also couple `Spatie\Html\Elements` to other concepts like requests, sessions and models.

For example when building input fields the `Html` builder will pull old values from the session (on a failed form request) or use values of a given model for the `value` attribute of the input.

Because the `Html` builder will generally return `Spatie\Html\Elements`, you can chain most of the [elements' fluent methods](/html/v1/general-usage/element-methods) directly onto the builder.

## Rendering elements

Every `Element` instance can be rendered to an HTML string using the `render()` method or simply by using it in a string context.

```php
echo Div::render();
// "<div></div>"

$elementInstance = new Div();
$htmlString = (string) $elementInstance;
// $htmlString is now "<div></div>"
```
