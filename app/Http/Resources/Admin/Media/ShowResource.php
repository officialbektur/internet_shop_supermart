<?php

namespace App\Http\Resources\Admin\Media;

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
		$srcAverage = $this->src_average;

		if (Str::startsWith($srcAverage, 'http://') || Str::startsWith($srcAverage, 'https://')) {
			return [
				"id" => $this->id,
				"src_average" => $srcAverage,
			];
		} else {
			return [
				"id" => $this->id,
				"src_average" => asset('storage/project/product/src_average/' . $srcAverage),
			];
		}
	}
}
