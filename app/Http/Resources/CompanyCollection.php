<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CompanyCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return CompanyResource::collection($this->collection);
    }
}
