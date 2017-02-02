---
title: Defining conversions
---

A media conversion can be added to your model in the `registerModelConversions`-function.
It should start with a call to `addMediaConversion`. From there on you can use any of
the methods available in the API. They are all chainable.

Take a look in the [Defining conversions section](/laravel-medialibrary/v5/converting-images/defining-conversions/)
for more details.

## General methods

### addMediaConversion

```php
/**
 * Add a conversion.
 *
 * @param string $nam
 *
 * @return \Spatie\MediaLibrary\Conversion\Conversion
 */
public function addMediaConversion($name)
```

### performOnCollections

```php
/**
 * Set the collection names on which this conversion must be performed.
 *
 * @param string $collectionNames,...
 *
 * @return $this
 */
public function performOnCollections($collectionNames)
``` 

### setManipulations

Note: you should pass an array with Glide parameters to `$manipulations`.

```php
/**
 * Set the manipulations for this conversion.
 *
 * @param string $manipulations,...
 *
 * @return $this
 */
public function setManipulations($manipulations)
```

### queued

```php 
/**
 * Mark this conversion as one that should be queued.
 *
 * @return $this
 */
 public function queued()
```

### nonQueued

```php 
/**
 * Mark this conversion as one that should not be queued.
 *
 * @return $this
 */
public function nonQueued()
```


