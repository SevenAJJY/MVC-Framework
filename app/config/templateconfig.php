<?php

return [
    'template' =>[
        'WRAPPERSTART'       => TEMPLATE_PATH . 'wrapperstart.php',
        'NAV'                => TEMPLATE_PATH . 'nav.php',
        'HEADER'             => TEMPLATE_PATH . 'header.php',
        ':VIEW'              => ':actionView' ,
        'STYLESWITCHER'      =>  TEMPLATE_PATH . 'styleSwitcher.php',
        'WRAPPEREND'         => TEMPLATE_PATH . 'wrapperend.php',
    ],
    'headerResources' => [
        'css' => [
            'NORMALIZE'      => CSS . 'normalize.css',
            'FAWSOME'        => CSS . 'fawsome.css',
            'FAWSOME_MIN'    => CSS . 'fontawesome.min.css',
            'STYLEBOOTSTRAP' => CSS . 'styleBootstrap.css',
            'STYLE'          => CSS . 'style.css',
            'MAIN'           => CSS . 'main.css',
        ]
        ,
        'JS' => [
            'modernizr' => JS . 'vendor/modernizr-2.6.2.min.js'
        ]
    ],
    'footerResources' => [
        'js' => [ 
            'JQUERY'         => JS . 'vendor/jquery-1.10.2.min.js',
            'BOOTSTRAP'      => JS . 'bootstrap.js',
            'APP'            => JS . 'app.js',
            'MAIN'           => JS . 'main.js',
        ]
    ]
];