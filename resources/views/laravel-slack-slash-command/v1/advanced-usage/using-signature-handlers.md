---
title: Using signature handlers
---

In Laravel's console commands a `signature` can be defined to set expections on the input.

You can use a `$signature` on your handler if you let your handler extend `Spatie\SlashCommand\Handlers\SignatureHandler`. When doing that you can make use of the `getArgument` and `getOption` methods to get the values of arguments and options. 

Let's take a look at an example.

```php
namespace App\SlashCommandHandlers;

use Spatie\SlashCommand\Request;
use Spatie\SlashCommand\Response;
use Spatie\SlashCommand\Handlers\SignatureHandler;

class SendEmail extends SignatureHandler
{
    public $signature = "/your-command email:send {to} {$message} {--queue}"

    public function handle(Request $request): Response
    {   
        $to = $this->getArgument('to');
    
        $message = $this->getArgument('message');
        
        $queue = $this->getOption('queue') ?? 'default';
        
        //send email message...
    }
}
```

Noticed that there is no `canHandle` method present. The package will automatically determine that a command `/your-command email:send test@email.com hello` can be handled by this class.