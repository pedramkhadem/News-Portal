<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminNewsResource extends JsonResource
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
            'language'=>$this->language,
            'category_id'=>$this->category_id,
            'attributes'=>[
                'image'=>$this->image,
                'title'=>$this->title,
                'slug'=>$this->slug,
                'category'=>$this->category->name,
                'meta_title'=>$this->meta_title,
                "meta_description" =>$this->meta_description,
            ],
            'shortlink'=>$this->shortlink,
            'is_breaking_news'=>$this->is_breaking_news,
            'show_at_slider'=>$this->show_at_slider,
            'show_at_popular'=>$this->show_at_popular,
            'status'=>$this->show_at_popular,
            'created_at'=>(string)$this->created_at,
            'updated_at'=>(string)$this->updated_at,

        ];
    }
}
