<?php

use GuzzleHttp\HandlerStack;
use jjtbsomhorst\omdbapi\model\response\SearchResult;
use jjtbsomhorst\omdbapi\model\util\MediaType;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\DoctrineCacheStorage;
use Kevinrob\GuzzleCache\Storage\LaravelCacheStorage;
use Kevinrob\GuzzleCache\Storage\Psr6CacheStorage;
use Kevinrob\GuzzleCache\Strategy\PrivateCacheStrategy;
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


$page = 1;
/**
 * @var $response SearchResult
 */
$response = $c->searchRequest('Harry Potter',$page,MediaType::Movie)->execute();
$results = [];
while($response->hasMore()){
    array_push($results,$response->getSearch());
    $page = $response->getNextPage();
    error_log('Lets get page '.$page);
    /**
     * @var $response SearchResult;
     */
    $response = $c->searchRequest('Harry Potter',$page,MediaType::Movie)->execute();
}
//error_log('we are done');
//echo count($results);
//$response = $c->byIdRequest('tt0076759',MediaType::Movies)->execute();
echo json_encode($response);

