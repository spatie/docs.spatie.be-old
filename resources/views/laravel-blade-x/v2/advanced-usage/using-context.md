---
title: Using context
---


By default BladeX components only have access to variables that are passed to them via attributes or via the view model. In some cases you might find yourself passing the same variables to multiple components. Take a look at this example where we are building a form using some BladeX components.

```html
<input-field name="first_name" :model="$user" />

<input-field name="last_name" :model="$user" />

<input-field name="email" :model="$user" />
```

You can avoid having to pass `$user` to each component separatly by using a special component called `context`.

You can rewrite the above as

```html
<context :model="$user">
    <input-field name="first_name" />

    <input-field name="last_name" />

    <input-field name="email" />
</context>
```

The only restriction of `context` is that you shouldn't use it around a slot.

```html
<model-form>
    {{-- Don't do this: the variables in `context` will not be passed to `$slot`.
    <context :model="$user">
        {{ $slot }}
    </context>
</model-form>
```