<?php namespace Dizoo\PageHeaders\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Headers extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'manage-pageheaders' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Dizoo.PageHeaders', 'main-menu-item');
    }
}
