<?php

namespace jjtbsomhorst\omdbapi\model\request;

use http\Env\Response;
use jjtbsomhorst\omdbapi\model\response\SearchResult;
use jjtbsomhorst\omdbapi\model\util\MediaType;
use Psr\Http\Message\ResponseInterface;

class MovieSearchRequest extends BaseApiRequest
{
    public function search($term) : MovieSearchRequest{
        parent::setKey("s",$term);
        return $this->page(1);
    }

    public function page(int $p) : MovieSearchRequest{
        parent::setKey('page',$p);
        return $this;
    }

    public function type(MediaType $type) : MovieSearchRequest
    {
        parent::setKey('type',$type->asParamValue());
        return $this;
    }


    protected function transform(ResponseInterface $response)
    {
        $result = $this->deserialize($response,SearchResult::class);
        $result->setCurrentPage($this->getKey('page'));
        return $result;
    }
}