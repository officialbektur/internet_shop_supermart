<?php

namespace App\Http\Resources\Project\Media;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ShowResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		$srcMax = $this->src_max;
		$srcMin = $this->src_min;

		if (!Str::startsWith($srcMax, 'http://') && !Str::startsWith($srcMax, 'https://')) {
			$srcMax = asset('storage/project/product/src_max/' . $srcMax);
		}

		if (!Str::startsWith($srcMin, 'http://') && !Str::startsWith($srcMin, 'https://')) {
			$srcMin = asset('storage/project/product/src_min/' . $srcMin);
		}

		return [
			"src_max" => $srcMax,
			"src_min" => $srcMin,
		];
	}
}
