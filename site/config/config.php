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
            'pattern' => 'api-v2/site-informations',
            'action'  => function () {
                return new Page([
                    'slug'      => 'site-information',
                    'template'  => 'get.site_informations',
                ]);
            }
        ],
        [
            'method' => 'GET',
            'pattern' => 'api-v2/home',
            'action'  => function () {
                return new Page([
                    'slug'      => 'home',
                    'template'  => 'get.home',
                ]);
            }
        ],
        [
            'method' => 'GET',
            'pattern' => 'api-v2/partenaires',
            'action'  => function () {
                return new Page([
                    'slug'      => 'partners',
                    'template'  => 'get.partners',
                ]);
            }
        ],

        [
            'method' => 'GET',
            'pattern' => 'api-v2/fondation',
            'action'  => function () {
                return new Page([
                    'slug'      => 'fondation',
                    'template'  => 'get.fondation',
                ]);
            }
        ],
        [
            'method' => 'GET',
            'pattern' => 'api-v2/sections/(:any)',
            'action'  => function (string $sectionSlug) {
                return new Page([
                    'slug' => "sections/$sectionSlug",
                    'template' => 'get.section',
                ]);
            }
        ],
        [
            'method' => 'GET',
            'pattern' => 'api-v2/blog',
            'action'  => function () {
                return new Page([
                    'slug' => "blog",
                    'template' => 'get.blog',
                ]);
            }
        ],
        [
            'method' => 'GET',
            'pattern' => 'api-v2/blog/last',
            'action'  => function () {
                return new Page([
                    'slug' => 'blog/last',
                    'template' => 'get.blog.last',
                ]);
            }
        ],
        [
            'method' => 'GET',
            'pattern' => 'api-v2/blog/article/(:any)',
            'action'  => function (string $articleSlug) {
                return new Page([
                    'slug' => "blog/$articleSlug",
                    'template' => 'get.blog.article',
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
