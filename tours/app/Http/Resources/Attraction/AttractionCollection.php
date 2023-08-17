<?php

namespace App\Http\Resources\Attraction;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AttractionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'attractions';

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
