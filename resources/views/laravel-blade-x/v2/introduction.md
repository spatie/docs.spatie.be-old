---
title: Introduction
---

This package provides an easy way to render custom html components in your Blade views.

Here's an example. Instead of this:

```html
<h1>My view</h1>

@include('myAlert', ['type' => 'error', 'message' => $message])
```

you can write this

```html
<h1>My view</h1>

<my-alert type="error" :message="$message" />
```

You can place the content of that alert in a simple blade view that needs to be [registered](https://github.com/spatie/laravel-blade-x#usage) before using the `my-alert` component.

```html
{{-- resources/views/components/myAlert.blade.php --}}

<div class="{{ $type }}">
   {{ $message }}
</div>
```