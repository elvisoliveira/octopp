<?php

require_once 'vendor/autoload.php';

$url = file_get_contents("http://d24w6bsrhbeh9d.cloudfront.net/photo/{$_GET['image']}");

$img = __DIR__ . "/images/{$_GET['image']}";

file_put_contents($img, $url);

$imginfo = getimagesize($img);

header("Content-Type: image/jpeg");
header("Content-type: {$imginfo['mime']}");

print $url;