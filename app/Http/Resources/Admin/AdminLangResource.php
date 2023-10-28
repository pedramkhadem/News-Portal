<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminLangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=> $this->name,
            'attributes'=>[
                'lang'=>$this->lang,
                'slug'=>$this->slug,
                'default'=>$this->default,
                'status'=>$this->status,
            ],
            'created_at' => (string) $this->created_at,
            'updated_at' => (string)$this->updated_at,
        ];

    }
}
