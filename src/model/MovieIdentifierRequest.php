<?php

namespace model;

class MovieIdentifierRequest extends BaseIdentifierRequest
{
    public function execute() : MovieResult{
        $result = parent::execute();
    }
}