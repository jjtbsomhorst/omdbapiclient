<?php

namespace jjtbsomhorst\omdbapi\model\response;

use GuzzleHttp\Psr7\Response;

class SearchResult  extends Response
{
    /**
     * @var SearchResultEntry[] $search
     */
    private array $search;
    private string $totalResults;
    private int $currentPage;

    /**
     * @return SearchResultEntry[]
     */
    public function getSearch(): array
    {
        return $this->search;
    }

    /**
     * @param SearchResultEntry[] $search
     */
    public function setSearch(array $search): void
    {
        $this->search = $search;
    }

    /**
     * @return string
     */
    public function getTotalResults(): string
    {
        return $this->totalResults;
    }

    /**
     * @param string $totalResults
     */
    public function setTotalResults(string $totalResults): void
    {
        $this->totalResults = $totalResults;
    }



    /**
     * @param int $currentPage
     */
    public function setCurrentPage(int $currentPage): void
    {
        $this->currentPage = $currentPage;
    }

    public function hasMore(){
        $pages = 1;
        if($this->totalResults > 10){
            $leftover = $this->totalResults % 10;
            $pages =  ($this->totalResults - $leftover) / 10;
            if($leftover > 0){
                $pages += 1;
            }
        }

        return ($this->currentPage < $pages);
    }

    public function getNextPage() :int{
        return $this->currentPage+1;
    }
}