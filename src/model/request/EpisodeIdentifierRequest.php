<?php

namespace jjtbsomhorst\omdbapi\model\request;

use jjtbsomhorst\omdbapi\model\request\MovieIdentifierRequest;
use jjtbsomhorst\omdbapi\model\response\EpisodeResult;
use jjtbsomhorst\omdbapi\model\response\SeriesResult;
use Psr\Http\Message\ResponseInterface;

class EpisodeIdentifierRequest extends MovieIdentifierRequest
{

    public function __construct()
    {
        $this->setKey('type','episode');
    }

    public function transform(ResponseInterface $response)
    {
        return $this->deserialize($response,EpisodeResult::class);
    }
}