<?php

header("Access-Control-Allow-Origin: *");

use Kirby\Cms;

/**
 * @var Cms\Page  $page
 * @var Cms\App   $app
 * @var Cms\User  $user
 * @var Cms\Site  $site
 */

//echo "<pre>";
//print_r($site->children()->get('plan')->template()->name());
//echo "</pre>";

/** @var Cms\Pages $sections */
$findSectionListedPage = $site->find('sections');

if( $findSectionListedPage->first() == null ) {
  echo json_encode([
    'errors' => ['can\'t find page "/sections/"'],
  ]);
  die();
}

$sections = $findSectionListedPage->childrenAndDrafts();

$pagesToReturn = $sections->map(function (Cms\Page $value){
  return [
    'title'       => $value->title(),
    'url'         => $value->url(),
    'slug'        => $value->slug(),
    'blueprint'   => $value->blueprint()->name(),
  ];
});

echo json_encode([
  'title'       => $site->title()->value(),
  'blogDetails' => [
    'title' => $site->find('blog')->title(),
  ],
  'sectionsDetails'    => $pagesToReturn->data(),
]);
