---
title: Checking for media existence using the service layer.
---

You may wish to automate checking media files or integrate it into your application's view somehow.
This can be achieved by using the provided CheckExistence service.
It is located at `Spatie\MediaLibrary\Services\CheckExistence`.
The API provided is:

```php
class CheckExistence {
   public function handle(string $filterType = 'none', Collection $models = null) : Traversable;
   public function handleAndReturn(string $filterType = 'none', Collection $models = null) : Collection;
}
```

### Handle

The `handle()` method is a [generator](http://php.net/manual/en/language.generators.overview.php).
It first will yield the total number of items that need to be gone through.
This is useful for example in the artisan command to setup the progress bar.

Each subsequent yeild is a simple value of `1`.
This is only to indicate that a loop has completed and it is onto the next.
In the artisan command, this is used to proceed the progress to let users know something is happening.

Finally, you need to call the `getReturn()` method on the generator to retrieve the output collection.
Then you can use the output collection as-needed to see the exact media items that *do not* exist on the filesystem.

Remember, this is a generator you *must* loop over it before `getReturn()` will provide a value.

### Handle and Return

The second provided method is `handleAndReturn()`.
It has the exact same signature as the `handle()` method since it only does an empty loop and returns the output.
This method is useful when you just want the output and don't care for updating a user interface.
For example, when writing your own automated script that no user interacts with directly.
