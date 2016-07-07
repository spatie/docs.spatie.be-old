---
title: Checking for file existence from the command line.
---

Verifying that the files exist on your service is provided through the command line.
If you provide no options, there will be a prompt asking you how to proceed.
Your options are:

1. `--all`
2. `--only=SomeClass,AnotherClass`
3. `--except=WhatClass`

Only *one* option can be used at a time.
`--all` takes precedent over `--only` and ``--except`.
`--only` will take precedent over `--except`.

For `--only` and `--except` you need to provide a comma separated list of fully qualified class names.
Only will provide results that match media items that are bound to the given classes.
Except will provide results that match everything except the provided classes.

```bash
$ php artisan medialibrary:checkExistence
```

```bash
$ php artisan medialibrary:checkExistence --all
```

```bash
# We will normalize namespaces as to what is provided in the database. Leading slashes don't matter, but do remember to escape them!
$ php artisan medialibrary:checkExistence --only=\\App\\Namespace\\SomeClass
```
