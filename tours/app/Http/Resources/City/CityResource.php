<?php

namespace App\Http\Resources\City;

use App\Http\Resources\Country\CountryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'city';

    public function toArray($request)
    {
        return [
            'name' => $this->resource->name,
            'founded' => $this->resource->founded,
            'country' => new CountryResource($this->resource->country)
        ];
    }
}
