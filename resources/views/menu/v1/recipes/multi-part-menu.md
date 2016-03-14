---
title: Multi Part Menu
---

```php
Menu::new()
    ->add(Menu::new()
        ->add('/introduction', 'Introduction')
        ->add('/requirements', 'Requirements')
        ->add('/installation-setup', 'Installation and Setup')
    )
    ->add(Menu::new()
        ->prepend('<h2>Basic Usage</h2>')
        ->add('/your-first-menu', 'Your First Menu')
        ->add('/working-with-items', 'Working With Items')
        ->add('/adding-sub-menus', 'Adding Sub Menus')
        ->prefixLinks('/basic-usage')
    );
```
