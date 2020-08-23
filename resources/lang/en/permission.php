<?php

return [
    'forms'         => [
        'name'   => 'Forms',
        'option' => [
            'read'        => 'Can access forms section.',
            'write'       => 'Can create and edit forms.',
            'delete'      => 'Can delete forms.',
            'assignments' => 'Can manage field assignments.',
        ],
    ],
    'notifications' => [
        'name'   => 'Notifications',
        'option' => [
            'read'   => 'Can access notifications section.',
            'write'  => 'Can create and edit notifications.',
            'delete' => 'Can delete notifications.',
        ],
    ],
    'fields'        => [
        'name'   => 'Fields',
        'option' => [
            'manage' => 'Can manage custom fields.',
        ],
    ],
];
