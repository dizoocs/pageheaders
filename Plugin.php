<?php namespace Dizoo\PageHeaders;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            \Dizoo\PageHeaders\Components\pageheader::class       => 'pageheader'
        ];
    }

    public function registerSettings()
    {
    }
    
    public function registerListColumnTypes()
    {
        return [
            'ucfirst' => [$this, 'upperCaseFirst'],
        ];
    }
    
    public function upperCasefirst($value, $column, $record)
    {
        return ucfirst($value);
    }
}
