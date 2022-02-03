<?php

use model\MovieSearchRequest;

class OmdbApiClient
{
    final private const host = "http://www.omdbapi.com";

    private string $apiKey;

    public function __construct(){}
    public function apiKey($key) : OmdbApiClient{
        $this->apiKey = $key;
        return $this;
    }

    public function searchRequest(string $term,int $page = 1) : MovieSearchRequest{
        return (new MovieSearchRequest())->apiKey($this->apiKey)->host(self::host)->search($term);
    }
    public function byIdRequest(string $id) : \model\BaseIdentifierRequest{
        return (new \model\BaseIdentifierRequest())->apiKey($this->apiKey)->host(self::host)->byId($id);
    }
    public function byTitleRequest(string $title): \model\BaseIdentifierRequest{
        return (new \model\BaseIdentifierRequest())->apiKey($this->apiKey)->host(self::host)->byTitle($title);
    }
}