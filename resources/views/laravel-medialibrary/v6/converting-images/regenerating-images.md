---
title: Regenerating images
---

When you change a conversion on your model, all images that were previously generated will not be updated automatically. You can regenerate your images via an artisan command. Note that conversions are often queued, so it might take a while to see the effects of the regeneration in your application.

```bash
$ php artisan medialibrary:regenerate
```

If you only want to regenerate the images for a single model, you can specify it as a parameter:

```bash
$ php artisan medialibrary:regenerate "App\Post"
```

If you only want to regenerate images for one or many specific conversions, you can use the `--only` option:

```bash
$ php artisan medialibrary:regenerate --only=thumb --only=foo
```

If you only want to regenerate missing images, you can use the `--only-missing` option:

```bash
$ php artisan medialibrary:regenerate --only-missing
```
