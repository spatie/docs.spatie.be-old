<?php

use App\Http\Navigation;
use League\CommonMark\CommonMarkConverter;

function markdown(string $markdown) : string
{
    return (new CommonMarkConverter())->convertToHtml($markdown);
}

function navigation() : Navigation
{
    return new Navigation();
}
