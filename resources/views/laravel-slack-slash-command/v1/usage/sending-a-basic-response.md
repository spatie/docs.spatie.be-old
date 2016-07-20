---
title: Sending a basic response
---

Whenever a user types in a slash command Slack will send an http request to the Laravel app. Keep in mind that you have only 3 seconds to respond. If handling the request takes longer that that you should use [delayed responses](/laravel-slack-slash-command/v1/usage/sending-delayed-responses).

Whenever a request from slack hits the Laravel app the package will go over all classes that are present in the `handlers` key of the config file. Let's review how you can create your own handler.

Here's a simple example:

```php
namespace App\SlashCommandHandlers;

use App\Jobs\TestJob;
use Spatie\SlashCommand\Request;
use Spatie\SlashCommand\Response;

class Hodor extends BaseHandler
{
    /**
     * If this function returns true, the handle method will get called.
     *
     * @param \Spatie\SlashCommand\Request $request
     *
     * @return bool
     */
    public function canHandle(Request $request): bool
    {
        return true;
    }

    /**
     * Handle the given request. Remember that Slack expects a response
     * within three seconds after the slash command was issued. If
     * there is more time needed, dispatch a job.
     * 
     * @param \Spatie\SlashCommand\Request $request
     * 
     * @return \Spatie\SlashCommand\Response
     */
    public function handle(Request $request): Response
    {
        return $this->respondToSlack("Hodor, hodor...");
    }
}
```

Do not forget to register your new command in the config file.

```php
    'handlers' => [
        App\SlashCommandHandlers\Hodor::class,
        ...
    },    
```

Now whenever you type in your slash command, you'll see that it'll response with `Hodor, hodor...`.



