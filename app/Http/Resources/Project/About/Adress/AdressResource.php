<?php

namespace App\Http\Resources\Project\About\Adress;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
			"map" => $this->map,
			"href" => $this->href,
			"title" => $this->title,
		];
    }
}
