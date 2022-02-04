<?php

namespace jjtbsomhorst\omdbapi;


use jjtbsomhorst\omdbapi\model\request\BaseIdentifierRequest;
use jjtbsomhorst\omdbapi\model\request\EpisodeIdentifierRequest;
use jjtbsomhorst\omdbapi\model\request\MovieIdentifierRequest;
use jjtbsomhorst\omdbapi\model\request\MovieSearchRequest;
use jjtbsomhorst\omdbapi\model\request\SeriesIdentifierRequest;

class OmdbApiClient
{
    private const host = "http://www.omdbapi.com";

    private string $apiKey;

    public function __construct()
    {
    }

    public function apiKey($key): OmdbApiClient
    {
        $this->apiKey = $key;
        return $this;
    }

    public function searchRequest(string $term, int $page = 1): MovieSearchRequest
    {
        return (new MovieSearchRequest())->apiKey($this->apiKey)->host(self::host)->search($term);
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
        $request->apiKey($this->apiKey)->host(self::host);
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
}