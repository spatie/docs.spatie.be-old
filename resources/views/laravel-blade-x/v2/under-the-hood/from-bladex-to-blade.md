---
title: From BladeX to Blade
---

When you register a component

```php
BladeX::component('components.myAlert')
```
with this html

```blade
{{-- resources/views/components/myAlert.blade.php --}}
<div class="{{ $type }}">
   {{ $message }}
</div>
```

and use it in your Blade view like this,

```blade
<my-alert type="error" :message="$message" />
```

our package will replace that html in your view with this:

```blade
@component('components/myAlert', ['type' => 'error','message' => $message,])@endcomponent
```

After that conversion Blade will compile (and possibly cache) that view.

Because all this happens before any html is sent to the browser, client side frameworks like Vue.js will never see the original html you wrote (with the custom tags).