<?php
return [
    'access' => [
        'add_name_role' => 'add_role'
    ],
    'permission_childen'=>[
        'list',
        'add',
        'edit',
        'delete'
    ],
    'permission_parent'=>[
        
        [
            'Category',
            'Quản lý loại hàng'
        ]
        ,
        [
            'products',
            'Quản lý sản phẩm'
        ]
        ,
        [
            'blog',
            'Quản lý bài viết'
        ]
        ,
        [
            'role',
            'Quản lý chức vụ'
        ]
        ,
        [
            'order',
            'Quản lý đơn hàng'
        ]
        ,
        [
            'branch',
            'Quản lý thương hiệu'
        ]
        ,
        [
            'permission',
            'Quản lý công việc'
        ]
        ,
        [
            'user',
            'Quản lý người dùng'
        ]
    ]
];
