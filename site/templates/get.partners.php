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
$findPatnersPage = $site->find('partenaires');

if( $findPatnersPage->first() == null ) {
  echo json_encode([
    'errors' => ['can\'t find page "home"'],
  ]);
  die();
}


echo json_encode([
  'title'       => $findPatnersPage->title()->value(),

//  'coverImage'  => getJsonEncodeImageData($findPatnersPage->coverImage()->toFile()),
  'textIntro'   => $findPatnersPage->textIntro()->value(),

  'partners'  => $findPatnersPage->partners()->toStructure()->map(
    fn($partnersItem) => getTeamItemStructure($partnersItem)
  )->data(),
]);
