---
title: Ordering media
---


Laravel medialibrary has a built in feature to help you order the media in your project. By default all inserted media
are ordered by they creation order (from the newest to the oldest) using the `order_column` column of the `media` table.

You can easily reorder a list of media using the  ̀Media::setNewOrder` static method:

```php
 /**
  * This function reorders the records: the record with the first id in the array
  * will get order 1, the record with the second it will get order 2, ...
  *
  * A starting order number can be optionally supplied (defaults to 1).
  *
  * @param array $ids
  * @param int   $startOrder
  */
Media::setNewOrder([11, 2, 26]);
```

If you have a more custom use case for medias order you can still take profit of the existing `order_column` column and
change it's value using the power of [Laravel eloquent](https://laravel.com/docs/5.3/eloquent):

```php
$media->order_column = 10;
$media->save();
```


 
