<?php
namespace Dizoo\PageHeaders\components;

use Cms\Classes\ComponentBase;
use Dizoo\PageHeaders\Models\Headers as Headers;

class PageHeader extends ComponentBase {

    public function componentDetails()
    {
        return [
            'name' => 'Page header',
            'description' => 'Adds a page header section to the page.'
        ];
    }

    public function onRun()
    {
        $this->page['pageheader'] = $this->getHeader();
        if($this->page['pageheader']) {
            $this->addCss('/plugins/dizoo/pageheaders/assets/css/header-style.css');
        }

    }

    public function getHeader()
    {
        $pageid = $this->page->id;
        $header = Headers::where('pageid', $pageid)->first();
        return $header ? $header : false;
    }
}