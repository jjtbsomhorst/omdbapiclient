<?php
namespace jjtbsomhorst\Omdbapi;

use jjtbsomhorst\omdbapi\model\BaseIdentifierRequest;
use jjtbsomhorst\omdbapi\model\MovieIdentifierRequest;
use jjtbsomhorst\omdbapi\model\MovieSearchRequest;

class OmdbApiClient
{
    private const host = "http://www.omdbapi.com";

    private string $apiKey;

    public function __construct(){}
    public function apiKey($key) : OmdbApiClient{
        $this->apiKey = $key;
        return $this;
    }

    public function searchRequest(string $term,int $page = 1) : MovieSearchRequest{
        return (new MovieSearchRequest())->apiKey($this->apiKey)->host(self::host)->search($term);
    }
    public function byIdRequest(string $id) : BaseIdentifierRequest{
        return (new MovieIdentifierRequest())->apiKey($this->apiKey)->host(self::host)->byId($id);
    }
    public function byTitleRequest(string $title): BaseIdentifierRequest{
        return (new MovieIdentifierRequest())->apiKey($this->apiKey)->host(self::host)->byTitle($title);
    }
}