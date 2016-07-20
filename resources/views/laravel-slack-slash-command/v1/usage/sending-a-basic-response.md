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
// app/config/laravel-slack-slash-command
    'handlers' => [
        App\SlashCommandHandlers\Hodor::class,
        ...
    },    
```

Now whenever you type in your slash command, you'll see that it'll response with `Hodor, hodor...`.

Let's create a slightly more advanced command.

```php
namespace App\SlashCommandHandlers;

use App\Jobs\TestJob;
use Spatie\SlashCommand\Request;
use Spatie\SlashCommand\Response;

class Repeat extends BaseHandler
{
    public function canHandle(Request $request): bool
    {
        return starts_with($request->text, 'repeat');
    }

    public function handle(Request $request): Response
    {   
        $textWithoutRepeat = substr($request->text, 7)
        
        return $this->respondToSlack("You said {$textWithoutRepeat}");
    }
}
```

Let's register this one as well.

```php
// app/config/laravel-slack-slash-command

    'handlers' => [
        App\SlashCommandHandlers\Repeat::class,
        App\SlashCommandHandlers\Hodor::class,
        ...
    },    
```

If you type in `/your-command repeat Hi, everybody` in a slack channel now, you'll get a response `Hi, everybody` back. When you type in `/your-command this does not exists` the package will output `Hodor` because the `Hodor` handler is the first one which `canHandle`-method returns `true`.
