<?php

namespace App\Http\Resources\Project\App\Telephone;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TelephoneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
			"href" => $this->href,
			"number" => $this->number
		];
    }
}
