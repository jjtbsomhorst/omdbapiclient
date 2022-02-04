<?php

namespace jjtbsomhorst\omdbapi\model;

use Doctrine\Common\Annotations\AnnotationReader;
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

        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

        $objectNormalizer = new ObjectNormalizer(
            $classMetadataFactory,
            null,
            null,
            new ReflectionExtractor()
        );
        $jsonEncoder = new JsonEncoder();
        $serializer = new Serializer([$objectNormalizer], [$jsonEncoder]);

        if($response->getStatusCode() == 200){
//            die($response->getBody());
            return $serializer->deserialize($response->getBody(), MovieResult::class, 'json');
        }
        return null;
    }
}