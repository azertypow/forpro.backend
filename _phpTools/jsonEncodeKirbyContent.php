<?php
use Kirby\Cms;

function getJsonEncodeFromSectionTypePlan(Cms\Page $page): array
{
    return [
        'title' => $page->title()->value(),
        'text'  => $page->text()->value(),
    ];
}

function getJsonEncodeFromSectionTypeIntroduction(Cms\Page $page): array
{
    return [
        'title' => $page->title()->value(),
        'cover' => (fn($page) => $page->cover()->toFiles()->map(
            fn($file) => getJsonEncodeImageData($file)
        )->data())($page),
        'text'  => $page->text()->value(),
    ];
}

function getJsonEncodeFromSectionTypeFoundation(Cms\Page $page): array
{
    return [
        'title' => $page->title()->value(),
        'cover' => (fn($page) => $page->cover()->toFiles()->map(
            fn($file) => getJsonEncodeImageData($file)
        )->data())($page),
        'text'  => $page->text()->value(),
    ];
}

function getJsonEncodeFromSectionTypeEvolution(Cms\Page $page): array
{
    return [
        'title' => $page->title()->value(),
        'gallery' => (fn($page) => $page->gallery()->toFiles()->map(
            fn($file) => getJsonEncodeImageData($file)
        )->data())($page),
        'text'  => $page->text()->value(),
    ];
}


function getJsonEncodeImageData(Cms\File $file): array
{
    return [
        'url'       => $file->url(),
        'mediaUrl'  => $file->mediaUrl(),
        'width'     => $file->width(),
        'height'    => $file->height(),
        'resize'    => [
            'tiny'      => $file->resize(50, null, 10)->url(),
            'small'     => $file->resize(500)->url(),
            'reg'       => $file->resize(1280)->url(),
            'large'     => $file->resize(1920)->url(),
        ]
    ];
}
