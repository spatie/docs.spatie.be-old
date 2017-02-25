---
title: Writing your own checks
---

Writing your own checks is very easy. Let's create a check that'll verify if `nginx` is running.

Let's take a look at how we can manually verify if nginx is running. The easiest way to do this is to run `systemctl is-active nginx`. This command will output  `active` if Nginx is running.

<img src="/images/server-monitor/nginx.jpg">

Let's create an automatic check using that command.

The first thing you must to do is create a class that extends from `Spatie\ServerMonitor\CheckDefinitions\CheckDefinition`.  Here's an example implementation.

```php
namespace App\MyChecks;

use Spatie\ServerMonitor\CheckDefinitions\CheckDefinition;
use Symfony\Component\Process\Process;

class Nginx extends CheckDefinition
{
    public $command = 'systemctl is-active nginx';

    public function handleSuccessfulProcess(Process $process)
    {
        if (str_contains($process->getOutput(), 'active')) {
            $this->check->succeeded('is running');

            return;
        }

        $this->check->failed('is not running');
    }
}
```

Let's go over this code in detail. The command that needs to be executed on the server needs to go in the `$command` property of that class.

The `handleSuccessfulProcess` function that accepts an instance of `Symfony\Component\Process\Process`. The output of that  `process` can be inspected using  `$process->getOutput()`. If the output contains `active` we'll call `$this->check->succeeded` which will mark the check as being succeed. If it does not contain that string `$this->check->failed` will be called which will mark the check as failed. By default the package will [send you a notification](https://docs.spatie.be/laravel-server-monitor/v1/monitoring-basics/configuring-notifications) whenever a check is marked as failed. The string that is passed to `$this->check->failed` will be displayed in the notification.

### Determining when a check will run the next time

 If you scheduled `php artisan server-monitor:run-checks`, [like we recommended](https://docs.spatie.be/laravel-server-monitor/v1/installation-and-setup#scheduling), to run every minute a check will, if it succeeds be run again after 10 minutes. If it succeeds it'll be run again the next minute.
 
 This behaviour is defined on the `Spatie\ServerMonitor\CheckDefinitions\CheckDefinition` class where all `CheckDefinitions` are extending from.
 
 ```php
 // in class Spatie\ServerMonitor\CheckDefinitions\CheckDefinition
 
 public function performNextRunInMinutes(): int
 {
     if ($this->check->hasStatus(CheckStatus::SUCCESS)) {
         return 10;
     }

     return 0;
 ```
 
You may override that function in your own check.

### Setting the timeout of a command

When executing a command on the server a timeout of 10 seconds will be used. If a command takes longer that that the check will be marked as failed.

 This behaviour is defined on the `Spatie\ServerMonitor\CheckDefinitions\CheckDefinition` class where all `CheckDefinitions` are extending from.
 
```php
public function timeoutInSeconds(): int
{
    return 10;
}
```

Need another timeout for your, just override the `timeoutInSeconds` function in your own check.

### Handling failed commands

Whenever your command itself fails, because eg a connection to the host couldn't be made or your command itself was invalid, `handleFailedProcess` will be called.

This is the default implementation on `Spatie\ServerMonitor\CheckDefinitions\CheckDefinition`:

```php 
public function handleFailedProcess(Process $process)
{
    $this->check->failed("failed to run: {$process->getErrorOutput()}");
}
```

Again, if you which to customize this behaviour, you can override that function in your own check.
