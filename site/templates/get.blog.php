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

$pagesToReturn = $articles->map(fn(Cms\Page $value) => getPreviewArticleData($value));

echo json_encode([
  'title'       => $blog->title()->value(),
  'pages'       => $pagesToReturn->data(),
]);
