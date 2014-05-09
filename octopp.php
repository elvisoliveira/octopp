<?php

require_once 'vendor/autoload.php';

use OctoPP\Parse;
use LSS\Array2XML;

$xml = Array2XML::createXML('articles', Parse::getFirstPage());

print $xml->saveXML();


