<?php

namespace jjtbsomhorst\omdbapi\model;

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

    public function execute() : ResponseInterface{
        $client = new Client();
        try{
            $properties = [];
            $properties['query'] = $this->getParams();
            if(!empty($this->proxy) && !is_null($this->proxy)){
                $properties['proxy'] = $this->proxy;
            }
            return $this->transform($client->request('GET',$this->getHost(),$properties));
        } catch (GuzzleException $e) {
            throw new OmdbApiException($e);
        }
    }

}