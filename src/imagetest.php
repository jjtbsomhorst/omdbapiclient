<?php

use jjtbsomhorst\omdbapi\model\request\PosterIdentifierRequest;
use jjtbsomhorst\omdbapi\model\util\MediaType;
use Symfony\Component\Cache\Adapter\RedisAdapter;

require __DIR__ .'/vendor/autoload.php';
//print_r($_ENV);
$c = new \jjtbsomhorst\omdbapi\OmdbApiClient();
$c->apiKey($_ENV['omdbapi']);
$redisClient = RedisAdapter::createConnection(
    'redis://redis'
);

$cache = new RedisAdapter(
    $redisClient,
    'omdb_api',
    60
);
$c->proxy('host.docker.internal',8888);
$c->cache($cache);
/**
 * @var PosterIdentifierRequest $request;
 */
$request = $c->byIdRequest('tt4513678',MediaType::Poster);
$response = $request->execute();
$response->getBody();
header('content-type: image/jpg');
echo $response->getBody();