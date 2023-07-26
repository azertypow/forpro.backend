<?php

require_once './_phpTools/jsonEncodeKirbyContent.php';

header("Access-Control-Allow-Origin: *");

use Kirby\Cms;

/**
 * @var Cms\Page  $page
 * @var Cms\App   $app
 * @var Cms\User  $user
 * @var Cms\Site  $site
 */

/** @var Cms\Pages $articles */
$blog = $site->find('blog');

$articles = $blog->children();

$pagesToReturn = $articles->map(function (Cms\Page $value){
  return [
    'title'       => $value->title(),
    'url'         => $value->url(),
    'slug'        => $value->slug(),
    'blueprint'   => $value->blueprint()->name(),
    'coverImage'      => getJsonEncodeImageData($value->coverImage()->toFile()),
    'typeOfContent'   => $value->typeOfContent(),
    'textIntro'       => $value->textIntro()->text(),
    'eventDate'       => $value->typeOfContent() == 'event' ? $value->eventDate() : null,
    'publicationDate' => $value->publicationDate(),
  ];
});

echo json_encode([
  'title'       => $blog->title()->value(),
  'pages'       => $pagesToReturn->data(),
]);
