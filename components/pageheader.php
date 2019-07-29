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
        $header = $this->getHeader();
        if($header) {
            $this->page['pageheader'] = $header;
            $this->addCss('/plugins/dizoo/pageheaders/assets/css/header-style.css');
        } else {
            $this->page['pageheader'] = false;
        }

    }

    public function getHeader()
    {
        $pageid = $this->page->id;
        return Headers::where('pageid', $pageid)->first();
    }
}