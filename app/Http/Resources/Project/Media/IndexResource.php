<?php

namespace App\Http\Resources\Project\Media;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class IndexResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		$srcAverage = $this->src_average;

		if (Str::startsWith($srcAverage, 'http://') || Str::startsWith($srcAverage, 'https://')) {
			return [
				"src_average" => $srcAverage,
			];
		} else {
			return [
				"src_average" => asset('storage/project/product/src_average/' . $srcAverage),
			];
		}
	}
}
