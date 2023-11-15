<?php

namespace App\Http\Resources\Admin\App\Soc;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
			"id" => $this->id,
			"icon" => $this->icon,
			"href" => $this->href,
			"name" => $this->name
		];
    }
}
