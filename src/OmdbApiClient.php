<?php

namespace jjtbsomhorst\omdbapi;


use jjtbsomhorst\omdbapi\model\request\BaseIdentifierRequest;
use jjtbsomhorst\omdbapi\model\request\EpisodeIdentifierRequest;
use jjtbsomhorst\omdbapi\model\request\MovieIdentifierRequest;
use jjtbsomhorst\omdbapi\model\request\MovieSearchRequest;
use jjtbsomhorst\omdbapi\model\request\SeriesIdentifierRequest;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

class OmdbApiClient
{
    private const host = "http://www.omdbapi.com";

    private string $apiKey = "";
    private ?CacheItemPoolInterface $cacheMechanism = null;
    private string $proxy = "";
    private int $proxyport = -1;

    public function __construct()
    {
    }

    public function cache(CacheItemPoolInterface  $cache){
        $this->cacheMechanism = $cache;
    }


    public function apiKey($key): OmdbApiClient
    {
        $this->apiKey = $key;
        return $this;
    }

    public function searchRequest(string $term, int $page = 1): MovieSearchRequest
    {
        return (new MovieSearchRequest())->apiKey($this->apiKey)->host(self::host)->search($term)->page($page)->cache($this->cacheMechanism)->proxy($this->proxy,$this->proxyport);
    }

    public function byIdRequest(string $id, string $type): BaseIdentifierRequest
    {
        return $this->byKeyRequest($id, 'id', $type);
    }

    private function byKeyRequest(string $identifier, string $identifierType, string $mediatype): ?BaseIdentifierRequest
    {
        $request = null;

        switch ($mediatype) {
            case 'series':
                $request = new SeriesIdentifierRequest();
                break;
            case 'episode':
                $request = new EpisodeIdentifierRequest();
                break;
            default:
                $request = new MovieIdentifierRequest();
                break;
        }
        $request->apiKey($this->apiKey)->host(self::host)->cache($this->cacheMechanism)->proxy($this->proxy,$this->proxyport);
        switch ($identifierType) {
            case 'id':
                return $request->byId($identifier);
            case 'title':
                return $request->byTitle($identifier);
        }
        return null;
    }


    public function byTitleRequest(string $title, string $type): BaseIdentifierRequest
    {
        return $this->byKeyRequest($title, 'title', $type);
    }

    public function proxy(string $host, int $port): OmdbApiClient
    {
        $this->proxy = $host;
        $this->proxyport = $port;
        return $this;
    }

}