<?php
/**
 * Created by PhpStorm .
 * User: trungphuna .
 * Date: 4/30/23 .
 * Time: 12:46 AM .
 */


return [
    [
        'icon'   => 'home',
        'name'   => 'Tổng quan',
        'route'  => 'get_admin.home',
        'prefix' => ['']
    ],
    [
        'icon'   => 'list',
        'name'   => 'Loài',
        'route'  => 'get_admin.category.index',
        'prefix' => ['category']
    ],
    [
        'icon'   => 'database',
        'name'   => 'Pet',
        'route'  => 'get_admin.pet.index',
        'prefix' => ['pet']
    ],
    [
        'icon'   => 'list',
        'name'   => 'Menu',
        'route'  => 'get_admin.menu.index',
        'prefix' => ['menu']
    ],
    [
        'icon'   => 'database',
        'name'   => 'Bài viết',
        'route'  => 'get_admin.article.index',
        'prefix' => ['product']
    ],
    [
        'icon'   => 'user',
        'name'   => 'User',
        'route'  => 'get_admin.user.index',
        'prefix' => ['user']
    ],
    // [
    //     'icon'   => 'key',
    //     'name'   => 'Permission',
    //     'route'  => 'get_admin.permission.index',
    //     'prefix' => ['permission']
    // ],
    // [
    //     'icon'   => 'layers',
    //     'name'   => 'role',
    //     'route'  => 'get_admin.role.index',
    //     'prefix' => ['role']
    // ],
];
