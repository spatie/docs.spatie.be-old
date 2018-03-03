---
title: Storing media specific manipulations
---

A media object has a property `manipulations`, which can be set to an array of manipulation values, with their conversion name as key. The model must therefore implement the `HasMediaConversions`.

Let's take the example of an Image that needs a 90 degree rotation. This rotation cannot be applied to all media linked to the given `$newsItem`, and needs to be stored with the `$mediaItem`.

When saving the media object, the package will regenerate all files and use the saved manipulation as the first manipulation when creating a derived image.
```php
// Add a width filter to the 'thumb' manipulations
$mediaItem = $newsItem->addMedia($pathToFile)
                      ->withManipulations(['thumb' => [ 'orientation' => '90'],'anotherConversions' => [ 'orientation' => '90']]);
```

of if the image was already added to the newsItem, manipulations can be added by:

```php
// Add a width filter to the 'thumb' manipulations
$mediaItems = $newsItem->getMedia('images');
$mediaItems[0]->manipulations = ['thumb' => [ 'orientation' => '90'], 'anotherConversions' => [ 'orientation' => '90']];

// This will cause the thumb and anotherConversion conversions to be regenerated
$mediaItems[0]->save();
```

In the example above this means that a `thumb` and `anotherConversion` image will be created. 
First the rotation will be applied for this specific `$mediaItem`, then the conversions in the `$newsItem` will be applied.

Remark:
- As you can see: for each conversion an equivalent manipulations has to be present with the media object.
A nice PR would be to make wildcard manipulations:
```php
$mediaItems[0]->manipulations = ['*' => [ 'orientation' => '90']
```
so the orientation change happens for all conversions.

