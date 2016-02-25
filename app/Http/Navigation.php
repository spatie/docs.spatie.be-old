<?php

namespace App\Http;

use Spatie\Menu\Laravel\Menu;

class Navigation
{
    public function backup() : string
    {
        return Menu::create()
            ->addMenu($this->backupSubMenu()
                ->addLink('introduction', 'Introduction')
                ->addLink('overview', 'Overview')
            )
            ->addMenu($this->backupSubMenu('taking-backups', 'Taking Backups')
                ->addLink('overview', 'Overview')
                ->addLink('events', 'Events')
            )
            ->addMenu($this->backupSubMenu('cleaning-old-backups', 'Cleaning Old Backups')
                ->addLink('overview', 'Overview')
                ->addLink('events', 'Events')
            )
            ->setActiveFromRequest()
            ->render();
    }

    protected function backupSubMenu(string $prefix = '', string $title = '') : Menu
    {
        return $this->subMenu("laravel-backup/v3/{$prefix}", $title);
    }

    public function medialibrary()
    {
        return Menu::create()
            ->addMenu(function (Menu $menu) {
                $menu
                    ->setLinkPrefix(url('/laravel-medialibrary/v3'))
                    ->addLink('introduction', 'Introduction')
                    ->addLink('overview', 'Overview');
            })
            ->render();
    }

    protected function subMenu(string $prefix = '', string $title = '') : Menu
    {
        $menu = Menu::create()->setLinkPrefix(url($prefix));

        if (! empty($title)) {
            $menu->before("<h2>{$title}</h2>");
        }

        return $menu;
    }
}
