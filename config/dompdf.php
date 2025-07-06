<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    */
    'show_warnings' => false,   // Menghilangkan warning
    'public_path' => null,      // Null to use Laravel's public path
    'convert_entities' => true,
    'options' => [
        'isRemoteEnabled' => true,
        'isHtml5ParserEnabled' => true,
        'isPhpEnabled' => false,
        'enable_remote' => true,
        'enable_html5_parser' => true,
        'chroot' => realpath(base_path()),
    ]
];
