<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminHomeSectionResource extends JsonResource
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
            'language' => $this->language,
            'attributes'=>[
                'category_section_one' => $this->category_section_one,
                'category_section_two' => $this->category_section_two,
                'category_section_three' =>$this->category_section_three,
                'category_section_four' =>$this->category_section_four,
            ],

            'created_at'=>(string)$this->created_at,
            'updated_at'=>(string)$this->updated_at,

        ];
    }
}
