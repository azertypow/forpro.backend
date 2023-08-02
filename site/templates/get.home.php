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

/** @var Cms\Pages $sections */
$findHomePage = $site->find('home');

if( $findHomePage->first() == null ) {
  echo json_encode([
    'errors' => ['can\'t find page "home"'],
  ]);
  die();
}


echo json_encode([
  'title'       => $findHomePage->title()->value(),

  'coverImage'  => getJsonEncodeImageData($findHomePage->coverImage()->toFile()),
  'themeColor'  => $findHomePage->themeColor()->value(),
  'textIntro'   => $findHomePage->textIntro()->value(),
  'content'     => $findHomePage->blockContent()->toBlocks()->map(fn(Cms\Block $blockItem) => getDefaultBlogContent($blockItem))->data(),

  'imageFooter' =>  $findHomePage->imageFooter()->toFile() ? [
    'title'         => $findHomePage->imageFooter()->toFile()->title()->value(),
    'isfixed'       => $findHomePage->imageFooter()->toFile()->isfixed()->value(),
    'photographer'  => $findHomePage->imageFooter()->toFile()->photographer()->value(),
    'license'       => $findHomePage->imageFooter()->toFile()->license()->value(),
    'image'         => ($findHomePage->imageFooter()->toFile() instanceof Kirby\Cms\File)
      ? getJsonEncodeImageData($findHomePage->imageFooter()->toFile())
      : null,
  ] : null,
]);
