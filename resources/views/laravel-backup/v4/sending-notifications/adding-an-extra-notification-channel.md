---
title: Adding an extra notification channel
---

By default the  package can notify you via mail of Slack. It's easy to add an extra notification channel if you need to be notified in another way (such as Telegram and native mobile push notification, etc...).
 
 The Laravel community is awesome. Shortly after Laravel 5.3 was released various developer worked together to create 30+ notification channels. You can view them all on [http://laravel-notification-channels.com](http://laravel-notification-channels.com).
 
 In the following example we're going to add the Pusher push notifications channel.  All other notification drivers can be added in the same way.

### 1. Install an the notification channel driver

For Pusher Push notifications you should require this package

```php
laravel-notification-channels/pusher-push-notifications
```

After composer has pulled in the package, just follow [the installation instructions of the package](https://github.com/laravel-notification-channels#installation) to complete the installation.


### 2. Creating your own custom notification

Let say you want to be notified via Pusher push notifications when a backup fails. To make this happen you'll need to create your own `BackupFailed` notification claess. This is how such a class could look like:

```php
namespace App\Notifications;

use Spatie\Backup\Notifications\Notifications\BackupHasFailed as BaseNotification;
use NotificationChannels\PusherPushNotifications\Message;

class BackupHasFailed extends BaseNotification
{
    public function toPushNotification($notifiable)
    {
        return Message::create()
            ->iOS()
            ->badge(1)
            ->sound('fail')
            ->body("The backup of {$this->getApplicationName()} to disk {$this->getDiskName()} has failed");
    }
}
```

### 3. Register your custom notification in the config file

The last thing you'll need to do is to register your custom notification in the config file.

```php
// config/laravel-backup.php
use \NotificationChannels\PusherPushNotifications\Channe as PusherChannell

...

    'notifications' => [

        'notifications' => [
            \App\Notifications\BackupHasFailed::class => ['mail', 'slack',PusherChannelll::class],
            ...
```

