<?php

namespace jjtbsomhorst\omdbapi\model\request;

use jjtbsomhorst\omdbapi\model\response\SearchResult;
use Psr\Http\Message\ResponseInterface;

class MovieSearchRequest extends BaseApiRequest
{
    public function search($term){
        parent::setKey("s",$term);
        return $this->page(1);
    }

    public function page(int $p) : BaseApiRequest{
        parent::setKey('page',$p);
        return $this;
    }


    protected function transform(ResponseInterface $response)
    {
        /**
         * @var $result SearchResult
         */
        $result = $this->deserialize($response,SearchResult::class);
        $result->setCurrentPage($this->getKey('page'));
        return $result;
    }


}