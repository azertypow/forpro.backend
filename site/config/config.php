<?php

use Kirby\Cms\Page;

return [
    'debug' => true,
    'routes' => [
        [
            'method' => 'GET',
            'pattern' => ['/'],
            'action'  => function () {
                header('Location: /panel');
                die();
            }
        ],
        [
            'method' => 'GET',
            'pattern' => 'api-v2/site',
            'action'  => function () {
                return new Page([
                    'slug'      => 'api',
                    'template'  => "get.home",
                ]);
            }
        ],
        [
            'method' => 'GET',
            'pattern' => 'api-v2/sections/(:any)',
            'action'  => function (string $sectionSlug) {
                return new Page([
                    'slug' => "sections/$sectionSlug",
                    'template' => "get.section",
                ]);
            }
        ],
        [
            'method' => 'GET',
            'pattern' => 'api-v2/blog',
            'action'  => function () {
                return new Page([
                    'slug' => "blog",
                    'template' => "get.blog",
                ]);
            }
        ],
        [
            'method' => 'GET',
            'pattern' => 'api-v2/blog/(:any)',
            'action'  => function (string $articleSlug) {
                return new Page([
                    'slug' => "blog/$articleSlug",
                    'template' => "get.blog.article",
                ]);
            }
        ],
        [
            'method' => 'GET',
            'pattern' => '(:all)',
            'action'  => function () {
                return new Page([
                    'slug' => 'error',
                    'template' => 'default',
                ]);
            }
        ],
    ],
];
