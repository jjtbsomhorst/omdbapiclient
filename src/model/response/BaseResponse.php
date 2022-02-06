<?php

namespace jjtbsomhorst\omdbapi\model\response;

class BaseResponse implements \JsonSerializable
{

    private int $code;

    public function setStatusCode(int $code){
        $this->code = $code;
    }
    public function jsonSerialize(): mixed
    {
        return array('code'=>$this->code);
    }
}