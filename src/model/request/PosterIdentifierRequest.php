<?php

namespace jjtbsomhorst\omdbapi\model\request;

use GuzzleHttp\Exception\GuzzleException;
use jjtbsomhorst\omdbapi\exception\OmdbApiException;
use Psr\Http\Message\ResponseInterface;

class PosterIdentifierRequest extends BaseIdentifierRequest
{

    public function byId($id): PosterIdentifierRequest
    {
        $this->unsetKey("t");
        $this->setKey("i", $id);
        return $this;
    }

    public function execute() : ?ResponseInterface
    {

        try {

            $properties = [];
            $properties['query'] = $this->getParams();

            $response = $this->getClient()->request('GET', '', $properties);
            if ($response->getStatusCode() != 200) {
                throw new OmdbApiException($response->getReasonPhrase(), $response->getStatusCode());
            }
            return $response;

        } catch (GuzzleException $e) {
            throw new OmdbApiException($e);
        }
    }

    protected function transform(ResponseInterface $response)
    {
        // TODO: Implement transform() method.
        return $response;
    }
}