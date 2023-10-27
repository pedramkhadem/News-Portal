<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminCatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,
            'language'=>$this->language,
            'attributes'=>[
                'name'=> $this->name,
                'slug'=>$this->slug,
                'show_at_nav'=>$this->show_at_nav,
                'status'=>$this->status
            ],
            'created_at' =>(string)$this->created_at,
            'updated_at' => (string)$this->updated_at,

        ];
    }
}
