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

if($page->blueprint()->name() != 'pages/batiment.lab') {
  echo json_encode(
    [
      'errors' => ['not found', $slugFromApiRequest.' don\'t use "pages/batiment.lab" blueprint name'],
    ]
  );
  die();
}

echo json_encode([
  'title' => $page->title()->value(),

  'coverImage' => getImageArrayDataInPage($page),
  'themeColor' => $page->themeColor()->value(),
  'textIntro' => $page->textIntro()->value(),
  'content' => $page->blockContent()->toBlocks()->map(function (Cms\Block $blockItem) {
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
  'faqTitle' => $page->faqTitle()->value(),
  'faqOption' => $page->faqOption()->value(),

]);
