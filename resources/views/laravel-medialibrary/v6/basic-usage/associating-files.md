---
title: Associating files
---

You can associate a file with a model like this:

```php
$newsItem = NewsItem::find(1);
$newsItem
   ->addMedia($pathToFile)
   ->toMediaCollection();
```

The file will now be associated with the `NewsItem` instance and will be moved to the disk you've configured.

If you want to not move, but copy, the original file you can call `preservingOriginal`:

```php
$newsItem
   ->addMedia($pathToFile)
   ->preservingOriginal()
   ->toMediaCollection();
```

You can also add a remote file to the media library:

```php
$url = 'http://medialibrary.spatie.be/assets/images/mountain.jpg';
$newsItem
   ->addMediaFromUrl($url)
   ->toMediaCollection();
```

It is important to note that the media library does not restrict what kinds of files may be uploaded or associated with models. If you are accepting file uploads from users, you should take steps to validate those uploads, to ensure you don't introduce security vulnerabilities into your software. Laravel has built-in validation  that can be used to restrict file uploads based on MIME type or file extension. [See the Laravel documentation](https://laravel.com/docs/validation) for more information on how to implement appropriate validation.
