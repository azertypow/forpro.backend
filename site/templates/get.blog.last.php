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

/** @var Cms\Page $blog */
$blog = $site->find('blog');




echo json_encode([
  'lastEvent'         => getPreviewArticleData(getNewsByTypeOfContent($blog, 'event')->last()),
  'lastArticle'       => getPreviewArticleData(getNewsByTypeOfContent($blog, 'article')->last()),
  'lastProject'       => getPreviewArticleData(getNewsByTypeOfContent($blog, 'project')->last()),
  'lastConstruction'  => getPreviewArticleData(getNewsByTypeOfContent($blog, 'construction')->last()),
]);
