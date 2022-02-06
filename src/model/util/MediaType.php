<?php
namespace jjtbsomhorst\omdbapi\model\util;
enum MediaType{
    case Movie;
    case Episodes;
    case Series;

    public function asParamValue():string{
        return strtolower($this->name);
    }
}

