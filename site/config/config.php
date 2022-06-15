<?php

use Kirby\Cms\Page;

return [
    'debug' => true,
    'routes' => [
        [
            'pattern' => '/',
            'action'  => function () {
                return new Page([
                    'slug'      => 'api',
                    'template'  => "api-home",
                ]);
            }
        ],
    ],
];
