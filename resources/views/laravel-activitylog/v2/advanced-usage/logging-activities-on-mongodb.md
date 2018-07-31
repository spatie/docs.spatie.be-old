---
title: Logging activities on MongoDB
---

Eloquent does not support natively MongoDB connection but you can decide to log your activities 
onto it anyway.

You can do it simply customizing the model used to save activity and with [`jenssegers/laravel-mongodb`](https://github.com/jenssegers/laravel-mongodb) package.

First you have to install `jenssegers/laravel-mongodb` in your application.
```
composer require jenssegers/laravel-mongodb
```

Then create your custom Activity model like this:

```php
namespace App;

use Spatie\Activitylog\Contracts\Activity as ActivityContract;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Jenssegers\Mongodb\Eloquent\Model as Moloquent;
class ActivityMongo extends Moloquent implements ActivityContract
{
    protected $connection = 'mongodb'; //mongodb connection
    protected $collection = 'activity_log';
    
```

Remember to update your `config/database.php` file and setup a connection for MongoDB:

```php
'mongodb' => [
            'driver' => 'mongodb',
            'host' => env('DB_HOSTMONGO', 'localhost'),
            'port' => env('DB_PORTMONGO', 27017),
            'database' => env('DB_DATABASEMONGO', 'admin'),
            'username' => env('DB_USERNAMEMONGO', ''),
            'password' => env('DB_PASSWORDMONGO', ''),
            'options' => [
                'database' => 'admin' // sets the authentication database required by mongo 3
            ]
        ],
```

Finally update the package config file and setup your custom Activity model:
```php
/*
     * This model will be used to log activity. The only requirement is that
     * it should be or extend the Spatie\Activitylog\Models\Activity model.
     */
    'activity_model' => \App\ActivityMongo::class,
```
## Update your relationships
If you are using the `CausesActivity` trait or some other trait shipped with this package on your models they have to be updated to support hybrid relations.
You have only to include `Jenssegers\Mongodb\Eloquent\HybridRelations` in your models like this:
```php
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class NewsItem extends Model
{
    use LogsActivity;
    use HybridRelations;

    protected static $logAttributes = ['*'];
    
    protected static $logAttributesToIgnore = [ 'text'];
    
    protected static $logOnlyDirty = true;
}
```