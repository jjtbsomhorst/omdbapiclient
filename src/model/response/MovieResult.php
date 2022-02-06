<?php

namespace jjtbsomhorst\omdbapi\model\response;

class MovieResult extends BaseResponse
{
    private string $title;

    private string $year;

    private string $rated;

    private \DateTime $released;

    private string $runtime;

    private string $genre;

    private string $director;

    private string $writer;

    private string $actors;

    private string $plot;

    private string $language;

    private string $country;

    private string $awards;

    private string $poster;

    public array $ratings;

    private string $metascore;
    private string $imdbRating;
    private string $imdbVotes;
    private string $imdbID;

    private string $type;

    private string $dVD;

    private string $boxOffice;

    private string $production;

    private string $website;
    private string $response;

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
    public function getRated(): string
    {
        return $this->rated;
    }

    /**
     * @param string $rated
     */
    public function setRated(string $rated): void
    {
        $this->rated = $rated;
    }

    /**
     * @return \DateTime
     */
    public function getReleased(): \DateTime
    {
        return $this->released;
    }

    /**
     * @param \DateTime $released
     */
    public function setReleased(\DateTime $released): void
    {
        $this->released = $released;
    }

    /**
     * @return string
     */
    public function getRuntime(): string
    {
        return $this->runtime;
    }

    /**
     * @param string $runtime
     */
    public function setRuntime(string $runtime): void
    {
        $this->runtime = $runtime;
    }

    /**
     * @return string
     */
    public function getGenre(): string
    {
        return $this->genre;
    }

    /**
     * @param string $genre
     */
    public function setGenre(string $genre): void
    {
        $this->genre = $genre;
    }

    /**
     * @return string
     */
    public function getDirector(): string
    {
        return $this->director;
    }

    /**
     * @param string $director
     */
    public function setDirector(string $director): void
    {
        $this->director = $director;
    }

    /**
     * @return string
     */
    public function getWriter(): string
    {
        return $this->writer;
    }

    /**
     * @param string $writer
     */
    public function setWriter(string $writer): void
    {
        $this->writer = $writer;
    }

    /**
     * @return string
     */
    public function getActors(): string
    {
        return $this->actors;
    }

    /**
     * @param string $actors
     */
    public function setActors(string $actors): void
    {
        $this->actors = $actors;
    }

    /**
     * @return string
     */
    public function getPlot(): string
    {
        return $this->plot;
    }

    /**
     * @param string $plot
     */
    public function setPlot(string $plot): void
    {
        $this->plot = $plot;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getAwards(): string
    {
        return $this->awards;
    }

    /**
     * @param string $awards
     */
    public function setAwards(string $awards): void
    {
        $this->awards = $awards;
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

    /**
     * @return  MovieRating[]
     */
    public function getRatings(): array
    {
        return $this->ratings;
    }

    /**
     * @param  MovieRating[] $phones
     */
    public function setRatings(array $ratings): void
    {
        $this->ratings = $ratings;
    }

    /**
     * @return string
     */
    public function getMetascore(): string
    {
        return $this->metascore;
    }

    /**
     * @param string $metascore
     */
    public function setMetascore(string $metascore): void
    {
        $this->metascore = $metascore;
    }

    /**
     * @return string
     */
    public function getImdbRating(): string
    {
        return $this->imdbRating;
    }

    /**
     * @param string $imdbRating
     */
    public function setImdbRating(string $imdbRating): void
    {
        $this->imdbRating = $imdbRating;
    }

    /**
     * @return string
     */
    public function getImdbVotes(): string
    {
        return $this->imdbVotes;
    }

    /**
     * @param string $imdbVotes
     */
    public function setImdbVotes(string $imdbVotes): void
    {
        $this->imdbVotes = $imdbVotes;
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
    public function getDVD(): string
    {
        return $this->dVD;
    }

    /**
     * @param string $dVD
     */
    public function setDVD(string $dVD): void
    {
        $this->dVD = $dVD;
    }

    /**
     * @return string
     */
    public function getBoxOffice(): string
    {
        return $this->boxOffice;
    }

    /**
     * @param string $boxOffice
     */
    public function setBoxOffice(string $boxOffice): void
    {
        $this->boxOffice = $boxOffice;
    }

    /**
     * @return string
     */
    public function getProduction(): string
    {
        return $this->production;
    }

    /**
     * @param string $production
     */
    public function setProduction(string $production): void
    {
        $this->production = $production;
    }

    /**
     * @return string
     */
    public function getWebsite(): string
    {
        return $this->website;
    }

    /**
     * @param string $website
     */
    public function setWebsite(string $website): void
    {
        $this->website = $website;
    }

    /**
     * @return string
     */
    public function getResponse(): string
    {
        return $this->response;
    }

    /**
     * @param string $response
     */
    public function setResponse(string $response): void
    {
        $this->response = $response;
    }

    public function jsonSerialize(): mixed
    {
       return array(
           'title' => $this->getTitle(),
           'year'=> $this->getYear(),
           'rated' => $this->getRated(),
           'released' => $this->getReleased(),
           'runtime'=>$this->getRuntime(),
           'genre' => explode(',',$this->getGenre()),
           'director'=> $this->getDirector(),
           'writer'=> $this->getWriter(),
           'actors' => explode(',',$this->getActors()),
           'plot' => $this->getPlot(),
           'language'=> $this->getLanguage(),
           'country' => $this->getLanguage(),
           'awards' =>$this->getAwards(),
           'poster' => $this->getPoster(),
           'ratings' => $this->getRatings(),
           'metascore' => $this->getMetascore(),
           'imdbRating' => $this->getImdbRating(),
           'imdbVotes' => $this->getImdbVotes(),
           'imdbID' => $this->getImdbID(),
           'type'=> $this->getType(),
           'dvd' => $this->getDVD(),
           'boxoffice' => $this->getBoxOffice(),
           'production' => $this->getProduction(),
           'website'=> $this->getWebsite()
       );
    }

}