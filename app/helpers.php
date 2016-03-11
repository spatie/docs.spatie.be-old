<?php

use App\Http\Navigation;
use League\CommonMark\CommonMarkConverter;
use Spatie\Menu\Laravel\Menu;

function markdown(string $markdown) : string
{
    return (new CommonMarkConverter())->convertToHtml($markdown);
}

function menu($menu) : Menu
{
    return app(Navigation::class)->$menu();
}
