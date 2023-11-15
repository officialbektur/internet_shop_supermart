<?php

namespace App\Http\Resources\Admin\Search;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HintResource extends JsonResource
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
			"name" => $this->name,
			"status" => is_null($this->deleted_at) ? 1 : 0,
		];
    }
}
