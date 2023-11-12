<?php

namespace App\Http\Resources\Admin\About\PlanWork;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanWorkResource extends JsonResource
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
			"mode" => $this->mode,
			"hours" => $this->hours
		];
    }
}
