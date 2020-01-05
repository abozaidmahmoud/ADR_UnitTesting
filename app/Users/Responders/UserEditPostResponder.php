<?php

namespace App\Users\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Users\Domain\Resources\PostResource;

class UserShowPostResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
        return response()->json(['posts'=>PostResource::collection($this->response->getData()),'status'=>$this->response->getStatus()]);
    }
}
