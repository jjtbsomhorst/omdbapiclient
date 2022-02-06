<?php

namespace jjtbsomhorst\omdbapi;



use jjtbsomhorst\omdbapi\model\request\BaseIdentifierRequest;
use jjtbsomhorst\omdbapi\model\request\EpisodeIdentifierRequest;
use jjtbsomhorst\omdbapi\model\request\MovieIdentifierRequest;
use jjtbsomhorst\omdbapi\model\request\MovieSearchRequest;
use jjtbsomhorst\omdbapi\model\request\SeriesIdentifierRequest;
use jjtbsomhorst\omdbapi\model\util\IdentifierType;
use jjtbsomhorst\omdbapi\model\util\MediaType;
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

    public function searchRequest(string $term, int $page = 1,MediaType $type = null): MovieSearchRequest
    {
        $request = (new MovieSearchRequest())->apiKey($this->apiKey)->host(self::host)->search($term)->page($page)->cache($this->cacheMechanism)->proxy($this->proxy,$this->proxyport);
        if($type != null){
            $request->type($type);
        }
        return $request;
    }

    public function byIdRequest(string $id, MediaType $type): BaseIdentifierRequest
    {
        return $this->byKeyRequest($id, IdentifierType::id, $type);
    }

    private function byKeyRequest(string $identifier, IdentifierType $identifierType, MediaType $mediaType): ?BaseIdentifierRequest
    {
        switch ($mediaType) {
            case MediaType::Series:
                $request = new SeriesIdentifierRequest();
                break;
            case MediaType::Episodes:
                $request = new EpisodeIdentifierRequest();
                break;
            case MediaType::Movie:
                $request = new MovieIdentifierRequest();
                break;
        }
        $request->apiKey($this->apiKey)->host(self::host)->cache($this->cacheMechanism)->proxy($this->proxy,$this->proxyport);
        switch ($identifierType) {
            case IdentifierType::id:
                return $request->byId($identifier);
            case IdentifierType::title:
                return $request->byTitle($identifier);
        }
        return null;
    }


    public function byTitleRequest(string $title, MediaType $type): BaseIdentifierRequest
    {
        return $this->byKeyRequest($title, IdentifierType::title, $type);
    }

    public function proxy(string $host, int $port): OmdbApiClient
    {
        $this->proxy = $host;
        $this->proxyport = $port;
        return $this;
    }

}