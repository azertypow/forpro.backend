<?php

use Kirby\Cms\Page;

return [
    'debug' => true,
    'routes' => [
        [
            'method' => 'GET',
            'pattern' => 'api.v2/site',
            'action'  => function () {
                return new Page([
                    'slug'      => 'api',
                    'template'  => "get.home",
                ]);
            }
        ],
        [
            'method' => 'GET',
            'pattern' => 'api.v2/section/(:any)',
            'action'  => function (string $any) {

//                echo "";

                return new Page([
                    'slug'      => 'api',
                    'template'  => "get.home",
                ]);
            }
        ],
    ],
];
