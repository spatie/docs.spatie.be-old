<?php

namespace App\Http\Navigation;

use Spatie\Menu\Laravel\Items\Link;
use Spatie\Menu\Laravel\Menu;

class Navigation
{
    public function menu() : Menu
    {
        $package = current_package();
        $version = current_version();

        return $this->generateMenu(
            "{$package}/{$version}",
            require(__DIR__ . "/{$package}-{$version}.php")
        );
    }

    private function generateMenu(string $prefix, array $items) : Menu
    {
        $contents = collect($items)->map(function (array $items, $title) use ($prefix) : Menu {

            $title = is_int($title) ? null : $title;

            $subMenuContents = collect($items)->map(function (string $item) use ($title) : Link {

                $url = str_slug($item);

                if (!is_null($title)) {
                    $url = str_slug($title) . '/' . $url;
                }

                return Link::to($url, $item);
            });

            return Menu::new($subMenuContents->toArray())
                ->prefixLinks("/{$prefix}")
                ->prependIf(!is_null($title), "<h2>{$title}</h2>");
        });

        return Menu::new($contents->toArray())->setActiveFromRequest();
    }
}
