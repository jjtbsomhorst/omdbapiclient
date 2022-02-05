<?php

namespace jjtbsomhorst\omdbapi\model\request;

use Doctrine\Common\Annotations\AnnotationReader;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use jjtbsomhorst\omdbapi\exception\OmdbApiException;
use jjtbsomhorst\omdbapi\model\util\MediaType;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\Psr6CacheStorage;
use Kevinrob\GuzzleCache\Strategy\GreedyCacheStrategy;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

abstract class BaseApiRequest
{
    private array $params = [];
    private string $apikey = "";
    private string $host;
    protected string $proxy;
    private CacheItemPoolInterface $cachePool;

    public function apiKey($key): BaseApiRequest
    {
        $this->apikey = $key;
        $this->setKey("apikey", $this->apikey);
        return $this;
    }

    protected function cachePool(CacheItemPoolInterface $pool): BaseApiRequest
    {
        $this->cachePool = $pool;
        return $this;
    }

    public function proxy(string $host, int $port): BaseApiRequest
    {
        if(!is_null($host) && !empty($host) && $port > -1){
            $this->proxy = $host . ":" . $port;
        }

        return $this;
    }

    public function cache($cache): BaseApiRequest
    {
        $this->cachePool = $cache;
        return $this;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    protected function unsetKey($param)
    {
        if (array_key_exists($param, $this->getParams())) {
            unset($this->getParams()[$param]);
        }
    }

    protected function setKey($param, $value)
    {
        $this->params[$param] = $value;
    }

    protected function getKey(string $key)
    {
        if (array_key_exists($key, $this->params)) {
            return $this->params[$key];
        }
        return null;
    }

    public function episode(): BaseApiRequest
    {
        $this->setkey("type", MediaType::Episodes);
        return $this;
    }

    public function plot(string $plottype): BaseApiRequest
    {
        $this->setKey('plot', $plottype);
        return $this;
    }

    public function movie(): BaseApiRequest
    {
        $this->setkey("type", MediaType::Movies->name);
        return $this;
    }

    public function series(): BaseApiRequest
    {
        $this->setkey("type", MediaType::Series->name);
        return $this;
    }

    public function year(int $year): BaseApiRequest
    {
        $this->setKey("y", $year);
        return $this;
    }

    public function host(string $host): BaseApiRequest
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    private function getClient(): Client
    {
        $props = [];
        $props['base_uri'] = $this->getHost();
        if (!empty($this->proxy) && !is_null($this->proxy)) {
            $props['proxy'] = $this->proxy;
        }

        if (!is_null($this->cachePool) && !empty($this->cachePool)) {
            $stack = HandlerStack::create();
            $stack->push(
                new CacheMiddleware(
                    new GreedyCacheStrategy(
                        new Psr6CacheStorage(
                            $this->cachePool),
                        1800,
                    )
                )
                ,
                'cache'
            );
            $props['handler'] = $stack;
        }

        return new Client($props);
    }

    public function execute(bool $deserialize = true): ResponseInterface
    {

        try {

            $properties = [];
            $properties['query'] = $this->getParams();

            $response = $this->getClient()->request('GET', '', $properties);
            if ($response->getStatusCode() != 200) {
                throw new OmdbApiException($response->getReasonPhrase(), $response->getStatusCode());
            }
            if ($deserialize) {
                return $this->transform($response);
            }
            return $response;
        } catch (GuzzleException $e) {
            throw new OmdbApiException($e);
        }
    }

    protected function deserialize(ResponseInterface $response, string $classname)
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

        $reflectionExtractor = new ReflectionExtractor();
        $phpDocExtractor = new PhpDocExtractor();
        $propertyTypeExtractor = new PropertyInfoExtractor(
            [$reflectionExtractor],
            [$phpDocExtractor, $reflectionExtractor],
            [$phpDocExtractor],
            [$reflectionExtractor],
            [$reflectionExtractor]);

        $normalizers = [
            new ObjectNormalizer($classMetadataFactory, NULL, NULL, $propertyTypeExtractor),
            new ArrayDenormalizer(),
            new DateTimeNormalizer(),
        ];
        $jsonEncoder = new JsonEncoder();
        $serializer = new Serializer($normalizers, [$jsonEncoder]);
        return $serializer->deserialize($response->getBody(), $classname, 'json');
    }
}