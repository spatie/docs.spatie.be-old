---
title: Enum Methods
---

## __toString()

will return the enum value.

```php
echo BoolEnum::make(1); // 'true'
```

## getIndex()

will return the enum index and could be overridden to customize the index.

```php
BoolEnum::true()->getIndex(); // 1
```

## getIndices()

will return all indices available on the enum.

```php
BoolEnum::getIndices(); // [0, 1]
```

## getValue()

will return the enum value and could be overridden to customize the value.

```php
BoolEnum::true()->getValue(); // 'true'
```

## getValues()

will return all values available on the enum.

```php
BoolEnum::getValues(); // ['false', 'true']
```

## isAny()

will return `true` if the enum is equal with any of the given - otherwise `false`.

```php
BoolEnum::true()->isAny(['true', 0]); // true
```

## isEqual()

will return `true` if the enum is equal with the given - otherwise `false`.

```php
BoolEnum::true()->isEqual([0]); // false
```

## make()

will return an instance of the enum - further details [make enum](/enum/v2/usage/make-enum).

## toArray()

will return an associative array with the value as key and the index as value.

```php
BoolEnum::toArray(); // ['false' => 0, 'true' => 1]
```
