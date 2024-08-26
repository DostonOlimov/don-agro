<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class AppLocalFileResource extends JsonResource
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
            'aDalolatnoma' => $this->a_dalolatnoma_file,
            'aXulosa' => $this->a_xulosa_file,
            'dXulosa' => $this->d_xulosa_file,
            'markirovka' => $this->markirovka_file,
            'certificate' => $this->old_certificate_file,

        ];
    }
}
