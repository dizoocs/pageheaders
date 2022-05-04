<?php namespace Dizoo\PageHeaders\Models;

use Model;
use Cms\Classes\Page as Pg;
use Cms\Classes\Theme;
use October\Rain\Database\Traits\Validation;

/**
 * Model
 */
class Headers extends Model
{
    use Validation;

    public $attachOne = [
        'image' => 'System\Models\File'
    ];

    public $timestamps = false;

    protected $pages = [];

    public function getPageidOptions() {

        $theme = Theme::getEditTheme();
        $pages = Pg::listInTheme($theme, true);
        $options = [];

        foreach($pages as $page) {
            $pageCheck = Headers::where('pageid', $page->id)->where('static_page', 0)->first();
            if (!$pageCheck || $page->id == $this->pageid) {
                $options[$page->id] = '[CMS] '.$page->title;
                $this->static_page = 0;
            }
        }

        if (class_exists('RainLab\Pages\Classes\PageList')) {
            $staticPages = new \RainLab\Pages\Classes\PageList($theme);
            foreach ($staticPages->listPages() as $name => $pageObject) {
                $staticCheck = Headers::where('pageid', $pageObject->id)->where('static_page', 1)->first();
                if (!$staticCheck || $pageObject->id == $this->pageid) {
                    $options[$pageObject->id] = '[Static] '.$pageObject->title;
                    $this->static_page = 1;
                }
            }
        }

        asort($options);
        return $options;
    }

    public function beforeCreate()
    {
        $this->static_page = $this->isStaticPage();
    }

    private function isStaticPage(): bool
    {
        if (!class_exists('RainLab\Pages\Classes\Page')) return 0;
        $theme = Theme::getEditTheme();
        $staticPages = new \RainLab\Pages\Classes\PageList($theme);
        foreach ($staticPages->listPages() as $name => $pageObject) {
            if ($this->pageid === $pageObject->id) return 1;
        }
        return 0;
    }

    public $table = 'dizoo_pageheaders_headers';

    public $rules = [
        'image' => 'required',
        'static_page' => 'boolean',
        'pageid' => 'required'
    ];
}
