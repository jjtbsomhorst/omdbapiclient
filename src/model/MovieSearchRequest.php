<?php

namespace jjtbsomhorst\omdbapi\model;

class MovieSearchRequest extends BaseApiRequest
{
    public function search($term){
        parent::setKey("s",$term);
        return $this;
    }

    public function page(int $p) : BaseApiRequest{
        parent::setKey('page',$p);
        return $this;
    }
}