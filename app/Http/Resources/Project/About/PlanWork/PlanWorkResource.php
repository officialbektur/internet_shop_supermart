<?php

namespace App\Http\Resources\Project\About\PlanWork;

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
			"mode" => $this->mode,
			"hours" => $this->hours
		];
    }
}
