---
title: Compare Enums
---

## Check if enums are equal

Equality enums mean that their values are identical.

```php
BoolEnum::true()->isEqual('true'); // true
BoolEnum::true()->isEqual(0); // false
BoolEnum::true()->isEqual(BoolEnum::false()); // false
```

## Check if enum is one of

```php
BoolEnum::true()->isAny(['true', 0, BoolEnum::false()]); // true
```

## Check if enum is specific one

```php
BoolEnum::true()->isTrue(); // true
BoolEnum::isTrue(0); // false
```
