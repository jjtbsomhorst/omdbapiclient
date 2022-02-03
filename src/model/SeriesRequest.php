<?php

namespace model;

class SeriesRequest extends BaseIdentifierRequest
{
    public function execute() : SeriesResult{
        $result = parent::execute();
    }
}