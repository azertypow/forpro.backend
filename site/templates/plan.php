<?php
use Kirby\Cms;

/**
 * @var Cms\Page  $page
 * @var Cms\App   $app
 * @var Cms\User  $user
 * @var Cms\Site  $site
 */

echo json_encode([
  'type'    => $page->template()->name(),
  'status'  => $page->status(),
  'title'   => $page->title()->value(),
  'text'    => $page->text()->value(),
]);
