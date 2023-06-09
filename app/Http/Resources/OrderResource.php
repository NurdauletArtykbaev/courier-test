<?php

namespace App\Http\Resources;

use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Resources\Admin\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'from' => new CityResource($this->whenLoaded('from')),
            'to' => new CityResource($this->whenLoaded('to')),
            'user' => new UserResource($this->whenLoaded('user')),
            'delivery_date' => $this->delivery_date,
            'status' => $this->status,
        ];
    }
}
