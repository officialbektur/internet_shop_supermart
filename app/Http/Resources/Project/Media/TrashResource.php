<?php

namespace App\Http\Resources\Project\Media;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class TrashResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		$srcMin = $this->src_min;

		if (Str::startsWith($srcMin, 'http://') || Str::startsWith($srcMin, 'https://')) {
			return [
				$srcMin,
			];
		} else {
			return [
				asset('storage/project/product/src_min/' . $srcMin),
			];
		}
	}
}
