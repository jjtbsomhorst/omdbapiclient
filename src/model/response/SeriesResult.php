<?php

namespace jjtbsomhorst\omdbapi\model\response;

use GuzzleHttp\Psr7\Response;

class SeriesResult extends MovieResult
{
    private string $totalSeasons;

    /**
     * @return string
     */
    public function getTotalSeasons(): string
    {
        return $this->totalSeasons;
    }

    /**
     * @param string $totalSeasons
     */
    public function setTotalSeasons(string $totalSeasons): void
    {
        $this->totalSeasons = $totalSeasons;
    }


}