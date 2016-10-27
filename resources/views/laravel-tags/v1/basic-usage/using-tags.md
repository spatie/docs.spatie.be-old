---
title: Using tags
---

To make an Eloquent model taggable just add the `\Spatie\Tags\HasTags` trait to it:

```php
class YourModel extends \Illuminate\Database\Eloquent\Model
{
    use \Spatie\Tags\HasTags;
    
    ...
}
```

#### Attaching tags

Here's how you can add some tags:

```php
//adding a single tag
$yourModel->attachTag('tag 1');

//adding multiple tags
$yourModel->attachTags(['tag 2', 'tag 3']);

//using an instance of \Spatie\Tags\Tag
$yourModel->attach(\Spatie\Tags\Tag::createOrFind('tag4'));
```

The tags will be stored in the `tags`-table. When using these functions we'll make sure that tags are unique and a model will have a tag attached only once.

#### Detaching tags

Here's how tags can be detached:

```php
//using a string
$yourModel->detachTag('tag 1');

//using an array
$yourModel->detachTags(['tag 2', 'tag 3']);

//using an instance of \Spatie\Tags\Tag
$yourModel->attach(\Spatie\Tags\Tag::Find('tag4'));
```

#### Syncing tags

By syncing tags the package will make sure only the tags given will be attached to the models. All other tags that were on the model will be detached.

```php
$yourModel->syncTags(['tag 2', 'tag 3']);
```