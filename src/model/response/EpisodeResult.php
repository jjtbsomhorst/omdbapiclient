<?php

namespace jjtbsomhorst\omdbapi\model\response;

class EpisodeResult extends MovieResult
{
    private string $seriesID = "";
    private string $season = "";
    private string $episode = "";

    /**
     * @return string
     */
    public function getSeriesID(): string
    {
        return $this->seriesID;
    }

    /**
     * @param string $seriesID
     */
    public function setSeriesID(string $seriesID): void
    {
        $this->seriesID = $seriesID;
    }

    /**
     * @return string
     */
    public function getSeason(): string
    {
        return $this->season;
    }

    /**
     * @param string $season
     */
    public function setSeason(string $season): void
    {
        $this->season = $season;
    }

    /**
     * @return string
     */
    public function getEpisode(): string
    {
        return $this->episode;
    }

    /**
     * @param string $episode
     */
    public function setEpisode(string $episode): void
    {
        $this->episode = $episode;
    }

}