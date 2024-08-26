<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class AppForeignFileResource extends JsonResource
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
            'fileCategory' => $this->file_category,
            'karantin' => $this->karantin_file,
            'fitosanitar' => $this->fitosanitar_file,
            'sertifikat' => $this->sertificat_file,
            'markirovka' => $this->markirovka_file,
            'invoys' => $this->invoys_file,
            'smr' => $this->smr_file,
            'yukXati' => $this->yuk_xati_file,

        ];
    }
}
