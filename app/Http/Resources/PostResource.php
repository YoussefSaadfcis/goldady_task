<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'post_id' => $this->id,
            'title' => $this->title,
            'body'=>$this->body,
            'image'=>$this->image,
            'category'=>$this->category->name,
            'user_id'=>$this->user->id,
            'user_name' => $this->user->name,
            'created_at'=>$this->created_at

        ];
    }
}
