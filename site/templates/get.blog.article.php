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

if($page == null) {
  // todo: clean error repeat code
  echo json_encode(
    [
      'errors' => [$slugFromApiRequest.' page does not exist'],
    ]
  );
  die();
}

if($page->blueprint()->name() != 'pages/blog.article') {
  echo json_encode(
    [
      'errors' => ['not found', $slugFromApiRequest.' don\'t use "pages/blog.article" blueprint name'],
    ]
  );
  die();
}


echo json_encode([
  'title' => $page->title(),

  'url'                 => $page->url(),
  'slug'                => $page->slug(),
  'blueprint'           => $page->blueprint()->name(),
  'textIntro'           => $page->textIntro()->text(),

  'coverImage'          =>  getJsonEncodeImageData($page->coverImage()->toFile()),
  'typeOfContent'       =>  $page->typeOfContent(),
//  todo: clean code repeat
  'blockContent'        =>  $page->blockContent()->toBlocks()->map(fn(Cms\Block $blockItem) => getDefaultBlogContent($blockItem))->data(),
  'eventDate'           =>  $page->typeOfContent() == 'event' ? $page->eventDate() : null,
  'publicationDate'     =>  $page->publicationDate(),
  'author'              =>  $page->author()->toUser()->username(),
]);


