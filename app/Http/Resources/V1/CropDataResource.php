<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class CropDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cropName' => optional($this->name)->name,
            'preName' => $this->pre_name,
            'nameId' => optional($this->name)->id,
            'cropType' => optional($this->type)->name,
            'typeId' => optional($this->type)->id,
            'cropGeneration' => optional($this->generation)->name,
            'generationId' => optional($this->generation)->id,
            'kodtnved' => $this->kodtnved,
            'partyNumber' => $this->party_number,
            'measureType' => $this->measure_type,
            'amount' => $this->amount,
            'year' => $this->year,
            'countryName' => optional($this->country)->name,
            'productionType' => new CropProductionCollection($this->whenLoaded('productions')),

        ];
    }
}
