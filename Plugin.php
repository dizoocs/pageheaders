<?php namespace Dizoo\PageHeaders;

use Dizoo\PageHeaders\Components\PageHeader;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            PageHeader::class       => 'pageheader'
        ];
    }

    public function registerSettings()
    {
    }

    public function registerListColumnTypes()
    {
        return [
            'ucfirst' => [$this, 'formatTitle'],
        ];
    }

    public function formatTitle($value, $column, $record)
    {
        return ucfirst(str_replace('-', ' ', $value));
    }
}
