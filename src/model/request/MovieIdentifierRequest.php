<?php

namespace jjtbsomhorst\omdbapi\model\request;

use Doctrine\Common\Annotations\AnnotationReader;
use jjtbsomhorst\omdbapi\exception\OmdbApiException;
use jjtbsomhorst\omdbapi\model\response\MovieResult;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class MovieIdentifierRequest extends BaseIdentifierRequest
{
    protected function transform(ResponseInterface $response)
    {
        return $this->deserialize($response,MovieResult::class);
    }
}