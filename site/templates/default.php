<?php
header("Access-Control-Allow-Origin: *");

echo json_encode(
  [
    'errors' => ['not found'],
  ]
);

