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
$findFondationPage = $site->find('fondation');

if( $findFondationPage->first() == null ) {
  echo json_encode([
    'errors' => ['can\'t find page "home"'],
  ]);
  die();
}


echo json_encode([
  'title'       => $findFondationPage->title()->value(),

//  'coverImage'  => getJsonEncodeImageData($findPatnersPage->coverImage()->toFile()),
  'textIntro'   => $findFondationPage->textIntro()->value(),

  'partners'  => $findFondationPage->partners()->toStructure()->map(
    fn($partnersItem) => getTeamItemStructure($partnersItem)
  )->data(),
]);
