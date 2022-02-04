<?php
namespace jjtbsomhorst\omdbapi\model;

use Psr\Http\Message\ResponseInterface;

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

    protected abstract function transform(ResponseInterface $response);
}