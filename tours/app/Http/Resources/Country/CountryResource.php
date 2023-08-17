<?php

namespace App\Http\Resources\Country;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'country';

    public function toArray($request)
    {
        return [
            'name' => $this->resource->name,
            'state regulation' => $this->resource->regulation
        ];
    }
}
