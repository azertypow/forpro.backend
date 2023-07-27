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

$slugFromApiRequest = $page->slug();


/** @var Cms\Page $page */
$page = $site->find( $slugFromApiRequest );

if($page->blueprint()->name() != 'pages/blog.article') {
  echo json_encode(
    [
      'errors' => ['not found', $slugFromApiRequest.' don\'t use "pages/blog.article" blueprint name'],
    ]
  );
  die();
}


echo json_encode([
  'title' => $page->title()->value(),

  'url'                 => $page->url(),
  'slug'                => $page->slug(),
  'blueprint'           => $page->blueprint()->name(),
  'textIntro'           => $page->textIntro()->text(),

  'coverImage'          =>  getImageArrayDataInPage($page),
  'typeOfContent'       =>  $page->typeOfContent(),
//  todo: clean code repeat
  'blockContent'        =>  $page->blockContent()->toBlocks()->map(function (Cms\Block $blockItem) {
    return $blockItem->type() != 'image' ?
      [
        'html'      => $blockItem->toHtml(),
        'type'      => $blockItem->type(),
        'isHidden'  => $blockItem->isHidden(),
      ]
      :
      [
        'data'     => [
          'title'         => $blockItem->title()->value(),
          'isfixed'       => $blockItem->isfixed()->value() == 'true',
          'photographer'  => $blockItem->photographer()->value(),
          'license'       => $blockItem->license()->value(),
          'image'         => ($blockItem->image()->toFile() instanceof Kirby\Cms\File)
            ? getJsonEncodeImageData($blockItem->image()->toFile())
            : null,
        ],
        'type'      => 'image',
        'isHidden'  => $blockItem->isHidden(),
      ];
  })->data(),
  'eventDate'           =>  $page->typeOfContent() == 'event' ? $page->eventDate() : null,
  'publicationDate'     =>  $page->publicationDate(),
  'author'              =>  $page->author()->toUser()->username(),
]);


