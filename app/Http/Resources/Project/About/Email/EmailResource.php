<?php

namespace App\Http\Resources\Project\About\Email;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmailResource extends JsonResource
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
			"email" => $this->email
		];
    }
}
