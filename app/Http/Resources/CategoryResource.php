<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        // 'category_name' => $this->name,
        return [
            'category_id' => $this->id,
            'category_name' => $this->name,
            'parent_id' =>  $this->parent_id,
            'children' => $this->children
        ];

    }
}
