<?php

header("Access-Control-Allow-Origin: *");

use Kirby\Cms;
include_once '_phpTools/jsonEncodeKirbyContent.php';

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
$sections = $site->childrenAndDrafts();

$pagesToReturn = $sections->map(function (Cms\Page $value){

  if($value->blueprint()->name() == 'pages/evolution')    return getJsonEncodeFromSectionTypeEvolution($value);
  if($value->blueprint()->name() == 'pages/foundation')   return getJsonEncodeFromSectionTypeFoundation($value);
  if($value->blueprint()->name() == 'pages/introduction') return getJsonEncodeFromSectionTypeIntroduction($value);
  if($value->blueprint()->name() == 'pages/plan')         return getJsonEncodeFromSectionTypePlan($value);
  if($value->blueprint()->name() == 'pages/team')         return getJsonEncodeFromSectionTypeTeam($value);

  return 'default';
});

echo json_encode([
  'title'       => $site->title()->value(),
  'footer'      => [
    'left'        => $site->textLeft()->value(),
    'right'       => $site->textRight()->value(),
  ],
  'sections'    => $pagesToReturn->data(),
]);
