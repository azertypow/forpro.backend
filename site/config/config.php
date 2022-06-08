<?php

return [
    'debug' => true,
    'routes' => [
        [
            'pattern' => '/',
            'action'  => function () {
                return 'Welcome to ForPro api';
            }
        ],
    ],
];
