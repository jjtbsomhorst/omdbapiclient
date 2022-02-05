<?php

use GuzzleHttp\HandlerStack;
use jjtbsomhorst\omdbapi\model\response\SearchResult;
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
    $namespace = 'omdb_api',
    $defaultLifetime = 60
);

$c->cache($cache);


$page = 1;
/**
 * @var $response SearchResult
 */
error_log("Search for hp page 1 ");


$response = $c->searchRequest('Harry Potter',$page)->execute();
echo $response->getTotalResults();
$results = [];


while($response->hasMore()){
    error_log('we have results and more data!!');
    array_push($results,$response->getSearch());
    $page = $response->getNextPage();
    error_log('Lets get page '.$page);
    /**
     * @var $response SearchResult;
     */
    $response = $c->searchRequest('Harry Potter',$page)->execute();
}
error_log('we are done');
echo count($results);

$response = $c->byIdRequest('tt0076759','movies')->execute();
echo "<br/>By id response";
print_r($response);


