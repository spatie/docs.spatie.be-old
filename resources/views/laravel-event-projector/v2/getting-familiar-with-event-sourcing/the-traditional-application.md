---
title: The traditional application
---

In a traditional application you're probably going to use a database to hold the state of your application. Whenever you want to update a bit a state, you're simply going to overwrite the old value. That old value isn't than accessible anymore. Your application only holds the current state.

You might think that you still have the old state inside your backups. But they don't count. Your app probably can't, nor should it, make descisions on data inside those backups.

**TODO: add value X image**
First we write value X

**TODO: add value Y image**
Next, we overwrite X by Y. X cannot be accessed anymore.

Here's a demo application that uses a traditional architecture. Inside the [`AccountsController`](https://github.com/spatie/larabank-traditional/blob/6ceb08f4700a9be72f0ebfe49b997d5871d64c6b/app/Http/Controllers/AccountsController.php) we are just going to [create new accounts](https://github.com/spatie/larabank-traditional/blob/6ceb08f4700a9be72f0ebfe49b997d5871d64c6b/app/Http/Controllers/AccountsController.php#L19-L27) and [update the balance](https://github.com/spatie/larabank-traditional/blob/6ceb08f4700a9be72f0ebfe49b997d5871d64c6b/app/Http/Controllers/AccountsController.php#L19-L27). We're using a eloquent model to update the database. Whenever we change the balance of the account, the old value is lost.