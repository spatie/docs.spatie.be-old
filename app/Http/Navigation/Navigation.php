<?php

namespace App\Http\Navigation;

use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;
use Illuminate\Support\Collection;

class Navigation
{
    protected $package;
    protected $version;

    public function __construct()
    {
        $this->package = current_package();
        $this->version = current_version();
    }

    public function menu() : Menu
    {
        return $this->generateMenu(
            "{$this->package}/{$this->version}",
            require(__DIR__ . "/{$this->package}-{$this->version}.php")
        );
    }

    protected function getFlattenedNavigation() : Collection
    {
        $navigation = require(__DIR__ . "/{$this->package}-{$this->version}.php");

        return collect($navigation)
            ->flatMap(function (array $block, string $title) : array {

                if (empty($title)) {
                    return collect($block)->map(function (string $page) {
                        return str_slug($page);
                    })->toArray();
                }

                return collect($block)->map(function (string $page) use ($title) {
                    $slug_title = str_slug($title);
                    $slug_page = str_slug($page);
                    return "{$slug_title}/{$slug_page}";
                })->toArray();
            });
    }

    public function getNextPage() : string
    {
        return $this->getPreviousOrNextPage(1);
    }

    public function getPreviousPage() : string
    {
        return $this->getPreviousOrNextPage(-1);
    }

    protected function getPreviousOrNextPage(int $addition) : string
    {
        $basePath = "{$this->package}/{$this->version}";

        $flattenedNavigation = $this->getFlattenedNavigation();

        $slug = collect(request()->segments())->except(0, 1)->implode('/');

        $currentIndex = $flattenedNavigation->search($slug);

        $page = $flattenedNavigation->get($currentIndex+$addition, '');

        return !empty($page) ? "{$basePath}/{$page}" : '';
    }

    protected function generateMenu(string $prefix, array $items) : Menu
    {
        $contents = collect($items)->map(function (array $items, $title) use ($prefix) : Menu {

            $title = is_int($title) ? null : $title;

            $subMenuContents = collect($items)->map(function (string $item) use ($prefix, $title) : Link {

                $url = str_slug($item);

                if (!is_null($title)) {
                    $url = str_slug($title) . '/' . $url;
                }

                return Link::toUrl("{$prefix}/{$url}", $item);
            });

            return Menu::new($subMenuContents->toArray())
                ->prependIf(!is_null($title), "<h2>{$title}</h2>");
        });

        return Menu::new($contents->toArray())->setActiveFromRequest();
    }
}
