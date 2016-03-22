---
title: Menu
---

### new

```php
/**
 * Create a new menu, optionally prefilled with items.
 *
 * @param array $items
 *
 * @return static
 */
public static function new(array $items = [])
```

### add

```php
/**
 * Add an item to the menu. This also applies all registered filters to the
 * item.
 *
 * @param \Spatie\Menu\Item $item
 *
 * @return $this
 */
public function add(Item $item)
```

### link

```php
/**
 * Shortcut function to add a plain link to the menu.
 *
 * @param string $url
 * @param string $text
 *
 * @return $this
 */
public function link(string $url, string $text)
```

### html

```php
/**
 * Shortcut function to add raw html to the menu.
 *
 * @param string $html
 *
 * @return $this
 */
public function html(string $html)
```

### each

```php
/**
 * Iterate over all the items and apply a callback. If you typehint the
 * item parameter in the callable, it wil only be applied to items of that 
 * type.
 *
 * @param callable $callable
 *
 * @return $this
 */
public function each(callable $callable)
```

### registerFilter

```php
/**
 * Register a filter to the menu. When an item is added, all filters will be
 * applied to the item. If you typehint the item parameter in the callable, it
 * will only be applied to items of that type.
 *
 * @param callable $callable
 *
 * @return $this
 */
public function registerFilter(callable $callable)
```

### applyToAll

```php
/**
 * Apply a callable to all existing items, and register it as a filter so it 
 * will get applied to all new items too. If you typehint the item parameter 
 * in the callable, it wil only be applied to items of that type.
 *
 * @param callable $callable
 *
 * @return $this
 */
public function applyToAll(callable $callable)
```

### prefixLinks

```php
/**
 * Prefix all the links in the menu.
 *
 * @param string $prefix
 *
 * @return $this
 */
public function prefixLinks(string $prefix)
```

### prepend

```php
/**
 * Prepend the menu with a string of html on render.
 *
 * @param string $prepend
 *
 * @return $this
 */
public function prepend(string $prepend)
```

### prependIf

```php
/**
 * Prepend the menu with a string of html on render if a certain condition is 
 * met.
 *
 * @param bool $condition
 * @param string $prepend
 *
 * @return $this
 */
public function prependIf(bool $condition, string $prepend)
```

### append

```php
/**
 * Append a string of html to the menu on render.
 *
 * @param string $append
 *
 * @return $this
 */
public function append(string $append)
```

### appendIf

```php
/**
 * Append the menu with a string of html on render if a certain condition is 
 * met.
 *
 * @param bool $condition
 * @param string $append
 *
 * @return static
 */
public function appendIf(bool $condition, string $append)
```

### isActive

```php
/**
 * Determine whether the menu is active.
 *
 * @return bool
 */
public function isActive() : bool
```

### setActive

```php
/**
 * Set multiple items in the menu as active based on a callable that filters 
 * through items. If you typehint the item parameter in the callable, it will 
 * only be applied to items of that type.
 *
 * @param callable|string $urlOrCallable
 * @param string $root
 *
 * @return $this
 */
public function setActive($urlOrCallable, string $root = '/')
```

### setActiveFromUrl

```php
/**
 * Set all relevant children active based on the current request's URL.
 *
 * /, /about, /contact => request to /about will set the about link active.
 *
 * /en, /en/about, /en/contact => request to /en won't set /en active if the
 *                                request root is set to /en.
 *
 * @param string $url The current request url.
 * @param string $root If the link's URL is an exact match with the request
 *                     root, the link won't be set active. This behavior is
 *                     to avoid having home links active on every request.
 *
 * @return $this
 */
public function setActiveFromUrl(string $url, string $root = '/')
```

### setActiveFromCallable

```php
/**
 * @param callable $callable
 *
 * @return $this
 */
public function setActiveFromCallable(callable $callable)
```

### setActiveClass

```php
/**
 * Set the class name that will be used on active items for this menu.
 * 
 * @param string $class
 *
 * @return $this
 */
public function setActiveClass(string $class)
```

### render

```php
/**
 * Render the menu.
 * 
 * @return string
 */
public function render() : string
```

### count

```php
/**
 * The amount of items in the menu.
 * 
 * @return int
 */
public function count() : int
```
