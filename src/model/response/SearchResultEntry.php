<?php

namespace jjtbsomhorst\omdbapi\model\response;

class SearchResultEntry implements \JsonSerializable
{
    private string $title;
    private string $year;
    private string $imdbID;
    private string $type;
    private string $poster;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getYear(): string
    {
        return $this->year;
    }

    /**
     * @param string $year
     */
    public function setYear(string $year): void
    {
        $this->year = $year;
    }

    /**
     * @return string
     */
    public function getImdbID(): string
    {
        return $this->imdbID;
    }

    /**
     * @param string $imdbID
     */
    public function setImdbID(string $imdbID): void
    {
        $this->imdbID = $imdbID;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getPoster(): string
    {
        return $this->poster;
    }

    /**
     * @param string $poster
     */
    public function setPoster(string $poster): void
    {
        $this->poster = $poster;
    }

    public function jsonSerialize(): mixed
    {
        return array(
            'imdbID' => $this->getImdbID(),
            'poster' => $this->getPoster(),
            'year'=>$this->getYear(),
            'title'=>$this->getTitle(),
            'type'=>$this->getType()
        );
    }
}