<?php

namespace model;

use exception\OmdbApiException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class BaseIdentifierRequest extends BaseApiRequest
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
            return $client->request('GET',$this->getHost(),['query' => $this->getParams()]);
        } catch (GuzzleException $e) {
            throw new OmdbApiException($e);
        }


    }



}