<?php
namespace jjtbsomhorst\omdbapi\model\util;
enum MediaType{
    case Movie;
    case Episodes;
    case Series;
    case Poster;
    public function asParamValue():string{
        return strtolower($this->name);
    }
}

