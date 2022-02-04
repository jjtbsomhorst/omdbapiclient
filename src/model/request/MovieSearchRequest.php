<?php

namespace jjtbsomhorst\omdbapi\model\request;

use jjtbsomhorst\omdbapi\model\response\SearchResult;
use Psr\Http\Message\ResponseInterface;

class MovieSearchRequest extends BaseApiRequest
{
    public function search($term){
        parent::setKey("s",$term);
        return $this;
    }

    public function page(int $p) : BaseApiRequest{
        parent::setKey('page',$p);
        return $this;
    }


    protected function transform(ResponseInterface $response)
    {
        return $this->deserialize($response,SearchResult::class);
    }
}