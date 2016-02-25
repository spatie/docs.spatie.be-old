<?php

namespace App\Http;

use Spatie\Menu\Laravel\Menu;

class Navigation
{
    public function backup() : string
    {
        return $this->generateMenu('laravel-backup/v3', [
            '_' => [
                'Introduction',
                'Requirements',
                'High level overview',
                'Installation and setup',
                'Questions and issues',
                'Changelog',
                'About us',
            ],
            'Taking backups' => [
                'Overview',
                'Events',
            ],
            'Cleaning up old backups' => [
                'Overview',
                'Events',
            ],
            'Monitoring the health of all backups' => [
                'Overview',
                'Events',
            ],
            'Sending notifications' => [
                'Overview',
                'Creating a custom sender',
            ],
            'Advanced usage' => [
                'Adding extra files to the zip',
            ],
        ])->render();
    }

    public function medialibrary() : string
    {
        return $this->generateMenu('laravel-medialibrary/v3', [
            '_' => [
                'Introduction',
                'Requirements',
                'Installation & setup',
                'Questions & issues',
                'Changelog',
            ],
            'Basic usage' => [
                'Preparing your model',
                'Associating files',
                'Retrieving media',
                'Working with collections',
            ],
            'Converting images' => [
                'Defining conversions',
                'Retrieving converted images',
                'Regenerating images',
            ],
            'Advanced usage' => [
                'Working with multiple filesystems',
                'Adding custom properties',
                'Generating custom URLs',
                'Storing media specific manipulations',
                'Using your own model',
                'Using a custom directory structure',
                'Consuming events',
            ],
            'API' => [
                'Adding files',
                'Defining conversions',
            ],
        ])->render();
    }

    protected function generateMenu(string $prefix, array $items) : Menu
    {
        $menu = Menu::create();

        collect($items)
            ->each(function (array $items, string $title) use ($prefix, $menu) {
                $subMenu = Menu::create()->setLinkPrefix("/{$prefix}");

                if ($title !== '_') {
                    $subMenu->before("<h2>{$title}</h2>");
                }

                collect($items)->each(function (string $item) use ($title, $subMenu) {
                    $url = str_slug($item);

                    if ($title !== '_') {
                        $url = str_slug($title) . '/' . $url;
                    }

                    $subMenu->addLink($url, $item);
                });

                $menu->addMenu($subMenu);
            });

        $menu->setActiveFromRequest();

        return $menu;
    }
}
