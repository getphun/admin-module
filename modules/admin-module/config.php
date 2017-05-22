<?php
/**
 * admin-module config file
 * @package admin-module
 * @version 0.0.1
 * @upgrade true
 */

return [
    '__name' => 'admin-module',
    '__version' => '0.0.1',
    '__git' => 'https://github.com/getphun/admin-module',
    '__files' => [
        'modules/admin-module'      => [ 'install', 'remove', 'update' ],
        'theme/admin/system/module' => [ 'install', 'remove', 'update' ]
    ],
    '__dependencies' => [
        'admin'
    ],
    '_services' => [],
    '_autoload' => [
        'classes' => [
            'AdminModule\\Controller\\ModuleController' => 'modules/admin-module/controller/ModuleController.php',
        ],
        'files' => []
    ],
    
    '_routes' => [
        'admin' => [
            'adminSystemModule' => [
                'rule' => '/system/modules',
                'handler' => 'AdminModule\\Controller\\Module::index'
            ]
        ]
    ],
    
    'admin' => [
        'menu' => [
            'system' => [
                'label'     => 'System',
                'icon'      => 'terminal',
                'order'     => 20000,
                'submenu'   => [
                    'modules'   => [
                        'label'     => 'Modules',
                        'perms'     => 'read_modules',
                        'target'    => 'adminSystemModule',
                        'order'     => 100
                    ]
                ]
            ]
        ]
    ]
];