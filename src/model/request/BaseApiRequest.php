<?php
namespace jjtbsomhorst\omdbapi\model\request;

use Doctrine\Common\Annotations\AnnotationReader;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use jjtbsomhorst\omdbapi\exception\OmdbApiException;
use jjtbsomhorst\omdbapi\model\response\MovieResult;
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
    protected string|int $proxy;

    public function apiKey($key): BaseApiRequest{
        $this->apikey = $key;
        $this->setKey("apikey",$this->apikey);
        return $this;
    }

    public function proxy(string $host, int $port) : BaseApiRequest{
        $this->proxy = $host.":".$port;
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

    public function episode(): BaseApiRequest
    {
        $this->setkey("type", "episode");
        return $this;
    }

    public function plot(string $plottype): BaseApiRequest
    {
        $this->setKey('plot', $plottype);
        return $this;
    }

    public function movie(): BaseApiRequest
    {
        $this->setkey("type", "movie");
        return $this;
    }

    public function series(): BaseApiRequest
    {
        $this->setkey("type", "series");
        return $this;
    }

    public function year(int $year): BaseApiRequest
    {
        $this->setKey("y", $year);
        return $this;
    }

    public function host(string $host): BaseApiRequest{
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

    public function execute() : ResponseInterface{
        $client = new Client();
        try{
            $properties = [];
            $properties['query'] = $this->getParams();
            if(!empty($this->proxy) && !is_null($this->proxy)){
                $properties['proxy'] = $this->proxy;
            }

            $response = $client->request('GET',$this->getHost(),$properties);
            if($response->getStatusCode() != 200){
                throw new OmdbApiException($response->getReasonPhrase(),$response->getStatusCode());
            }
            return $this->transform($response);
        } catch (GuzzleException $e) {
            throw new OmdbApiException($e);
        }
    }

    protected function deserialize(ResponseInterface $response, string $classname){
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