<?php

namespace jjtbsomhorst\omdbapi\model\request;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use jjtbsomhorst\omdbapi\exception\OmdbApiException;
use Psr\Http\Message\ResponseInterface;

abstract class BaseIdentifierRequest extends BaseApiRequest
{
    public function byTitle($title): BaseIdentifierRequest
    {
        $this->unsetKey("i");
        $this->setKey("t", $title);
        return $this;
    }

    public function byId($id): BaseIdentifierRequest
    {
        $this->unsetKey("t");
        $this->setKey("i", $id);
        return $this;
    }



}