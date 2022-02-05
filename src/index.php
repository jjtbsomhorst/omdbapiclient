<?php
require __DIR__ .'/vendor/autoload.php';
//print_r($_ENV);
$c = new \jjtbsomhorst\omdbapi\OmdbApiClient();
$c->apiKey($_ENV['omdbapi']);
print_r($c->searchRequest('Harry Potter',1)->execute());