<?php
return [
    'guest_user' => [
        'id' => env('GUEST_USER_ID'),
        'name' => 'ゲストユーザー',
        'email' => 'guest@guest.com',
        'password' => env('GUEST_USER_PASSWORD'),
    ],
];
