<?php
namespace Dizoo\PageHeaders\components;

use Cms\Classes\ComponentBase;
use Dizoo\PageHeaders\Models\Headers as Headers;

class PageHeader extends ComponentBase {

    public function componentDetails()
    {
        return [
            'name' => 'dizoo.pageheaders::lang.strings.page_header_title',
            'description' => 'dizoo.pageheaders::lang.strings.page_header_description'
        ];
    }

    public function defineProperties()
    {
        return [
            'include_css' => [
                'title'       => 'dizoo.pageheaders::lang.strings.include_css',
                'type'        => 'checkbox',
                'default'     => true,
            ]
        ];
    }

    public function onRun()
    {
        $this->page['pageheader'] = $this->getHeader();
        if ($this->page['pageheader'] && $this->property('inject_css') == true) {
            $this->addCss('/plugins/dizoo/pageheaders/assets/css/header-style.css');
        }

    }

    public function getHeader(): ?object
    {
        $pageid = $this->page->id;
        $header = Headers::where('pageid', $pageid)->first();
        return $header ? $header : null;
    }
}