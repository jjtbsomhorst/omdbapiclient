<?php
namespace model;

abstract class BaseApiRequest
{
    private array $params = [];
    private string $apikey = "";
    private string $host;

    public function apiKey($key): BaseApiRequest{
        $this->apikey = $key;
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



}