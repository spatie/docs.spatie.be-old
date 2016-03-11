<?php

use App\Http\Navigation\Navigation;
use League\CommonMark\CommonMarkConverter;
use Spatie\Menu\Laravel\Menu;

function markdown(string $markdown) : string
{
    return (new CommonMarkConverter())->convertToHtml($markdown);
}

function menu() : Menu
{
    return app(Navigation::class)->menu();
}

function current_package() : string
{
    return request()->segment(1);
}

function current_version() : string
{
    return request()->segment(2);
}