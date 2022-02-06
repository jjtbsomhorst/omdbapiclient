<?php

namespace jjtbsomhorst\omdbapi\model\response;

use JetBrains\PhpStorm\Internal\TentativeType;

class MovieRating implements \JsonSerializable
{
    private string $source = "";
    private string $value = "";

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource(string $source): void
    {
        $this->source = $source;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }


    public function jsonSerialize(): mixed
    {
        return array(
            'source' => $this->source,
            'value' => $this->value
        );
    }
}