<?php

namespace jjtbsomhorst\omdbapi\model;

class SeriesRequest extends BaseIdentifierRequest
{
    public function execute() : SeriesResult{
        $result = parent::execute();
    }
}