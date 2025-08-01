<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'user' => $this->user?->name,
            'hotel' => $this->hotel?->name,
            'review' => $this->review,
            'image' => $this->getFirstMediaUrl('review_image'),
            'created_at' => $this->created_at,
        ];    
    }
}
