<?php

namespace App\Http\Resources\Attraction;

use App\Http\Resources\City\CityResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AttractionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'attraction';

    public function toArray($request)
    {
        return [
            'name' => $this->resource->name,
            'type' => $this->resource->type,
            'location' => new CityResource($this->resource->city)
        ];
    }
}
