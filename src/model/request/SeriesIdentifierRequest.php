<?php

namespace jjtbsomhorst\omdbapi\model\request;

use jjtbsomhorst\omdbapi\model\request\MovieIdentifierRequest;
use jjtbsomhorst\omdbapi\model\response\MovieResult;
use jjtbsomhorst\omdbapi\model\response\SeriesResult;
use Psr\Http\Message\ResponseInterface;

class SeriesIdentifierRequest extends MovieIdentifierRequest
{

    public function __construct()
    {
        $this->series();
    }

    public function transform(ResponseInterface $response)
    {
        return $this->deserialize($response,SeriesResult::class);
    }

}