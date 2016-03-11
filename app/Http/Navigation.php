<?php

namespace App\Http;

use Spatie\Menu\Laravel\Items\Link;
use Spatie\Menu\Laravel\Menu;

class Navigation
{
    const NO_TITLE = 'noTitle';

    public function backup() : Menu
    {
        return $this->generateMenu('laravel-backup/v3', [

            static::NO_TITLE => [
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
                'Backing up a non-Laravel application',
            ],

        ]);
    }

    public function medialibrary() : Menu
    {
        return $this->generateMenu('laravel-medialibrary/v3', [

            static::NO_TITLE => [
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

        ]);
    }

    private function generateMenu(string $prefix, array $items) : Menu
    {
        $contents = collect($items)->map(function (array $items, string $title) use ($prefix) : Menu {

            $subMenuContents = collect($items)->map(function (string $item) use ($title) : Link {

                $url = str_slug($item);

                if (ends_with($url, 'introduction')) {
                    $url .= '#clean';
                }

                if ($title !==  static::NO_TITLE) {
                    $url = str_slug($title) . '/' . $url;
                }

                return Link::to($url, $item);
            });

            return Menu::new($subMenuContents->toArray())
                ->prefixLinks("/{$prefix}")
                ->prependIf($title !== static::NO_TITLE, "<h2>{$title}</h2>");

        });

        return Menu::new($contents->toArray())->setActiveFromRequest();
    }
}
