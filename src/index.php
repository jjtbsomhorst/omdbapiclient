<?php
require_once('OmdbApiClient.php');
use jjtbsomhorst\Omdbapi\OmdbApiClient;
require_once __DIR__ . '/vendor/autoload.php';

$cl = (new OmdbApiClient())->apiKey("62302d61");
//$response = $cl->byIdRequest("tt11946112","episode")->execute();
$response = $cl->searchRequest('Harry Potter','1')->execute();
print_r($response);