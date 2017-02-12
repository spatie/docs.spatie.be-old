---
title: Basic usage
---

In these basic examples we'll use the `BlogPost` model to add, update and remove some media files. 

Use the `list` command to see all all available commands for these examples:

```bash
php artisan list blogpost
```

![Blogpost commands](https://docs.spatie.be/images/medialibrary/tutorial/list-blogpost.jpg)

We've already prepared the `BlogPost` model for you by implementing `HasMedia` and the `HasMediaTrait`. Read more about preparing your model [in the documentation](https://docs.spatie.be/laravel-medialibrary/v5/basic-usage/preparing-your-model).

### Adding media to the blogpost (`BlogPostAddMedia.php`)

Use the following command to add media file to the existing `BlogPost` model. Media files aren't limited to images. Try adding `demofiles/hamlet.pdf` or `demofiles/coolvideo.webm`. You can add as many media files as you want.

```php
php artisan blogpost:add-media demofiles/sheep.jpg
```

![Blogpost add media](https://docs.spatie.be/images/medialibrary/tutorial/blogpost-addmedia.jpg)

As you can see, the media file is automatically _copied_ to the configured storage disk. This is because we used the `preservingOriginal` method. If you want to move the media file to the disk instead of copying it you can ignore this method.

Read more about adding media files to models in [the documentation](https://docs.spatie.be/laravel-medialibrary/v5/basic-usage/associating-files).

### Fetching all associated media from the blogpost (`BlogPostListMedia.php`)

Use the following command to fetch all media associated with the blogpost:

```php
php artisan blogpost:list-media
```

![Blogpost list media](https://docs.spatie.be/images/medialibrary/tutorial/blogpost-addmedia.jpg)

As you can see we've automagically added some meta data for your media files such as `mime_type`, `size` and `human_readable_size`.

### Updating associated media (`BlogPostUpdateMedia.php`)

As you can see from the previous example, every media file received a name and filename. You can easily update these names the way you're used to in Eloquent models.

```php
php artisan blogpost:update-media {id} --name="new name" --filename="new-filename.jpg"
```

![Blogpost list media](https://docs.spatie.be/images/medialibrary/tutorial/blogpost-updatemedia.jpg)

### Delete media files (`BlogPostDeleteMedia.php`)

The medialibrary provides a `delete` method to delete a single media association. This method will also remove the file from your filesystem.

```php
php artisan blogpost:delete-media {id}
```

![Blogpost list media](https://docs.spatie.be/images/medialibrary/tutorial/blogpost-deletemedia.jpg)

As you can see, the directory in `storage/app/media` with the `Media`'s `id` has been removed as well.

To delete all media files associated with a model you can use the `clearMediaCollection` method.

```php
php artisan blogpost:delete-media
```

![Blogpost list media](https://docs.spatie.be/images/medialibrary/tutorial/blogpost-deletemedia-2.jpg)

As you can see, all of the media directories associated with the `BlogPost` have now been removed from `storage/app/media` directory.