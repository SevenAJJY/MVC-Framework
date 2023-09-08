<?php

return [
    'template' =>[
        'WRAPPERSTART'       => TEMPLATE_PATH . 'wrapperstart.php',
        'HEADER'             => TEMPLATE_PATH . 'header.php',
        'NAV'                => TEMPLATE_PATH . 'nav.php',
        ':VIEW'              => ':actionView' ,
        'WRAPPEREND'         => TEMPLATE_PATH . 'wrapperend.php',
    ],
    'headerResources' => [
        'css' => [
            'NORMALIZE'      => CSS . 'normalize.css',
            'FAWSOME'        => CSS . 'fawsome.css',
            'STYLEBOOTSTRAP' => CSS . 'styleBootstrap.css',
            'STYLE'          => CSS . 'style.css',
            'MAIN'           => CSS . 'main.css',
        ],
    ],
    'footerResources' => [
        'js' => [ 
            'BOOTSTRAP'      => JS . 'bootstrap.js',
            'APP'            => JS . 'app.js',
            'MAIN'           => JS . 'main.js',
        ]
    ]
];