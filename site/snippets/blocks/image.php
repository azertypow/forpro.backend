<?php

require_once './_phpTools/jsonEncodeKirbyContent.php';


/** @var \Kirby\Cms\Block $block */
$alt     = $block->alt();
$caption = $block->caption();
$link    = $block->link();
$src     = null;

if ($block->location() == 'web') {
	$src = $block->src()->esc();
} elseif ($image = $block->image()->toFile()) {
	$alt = $alt->or($image->alt());
	$src = $image->url();
}

//print_r( getJsonEncodeImageData( $block->image()->toFile() ) );

if($block->image()->toFile() instanceof Kirby\Cms\File)
  echo json_encode( getJsonEncodeImageData($block->image()->toFile()) );
else echo null;
