<?php

namespace App\Http\Resources\Admin\Commentary;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Project\Category;
use App\Models\Project\Media;

use App\Http\Resources\NumberFormattingTrait;

class CommentaryResource extends JsonResource
{
	use NumberFormattingTrait;
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		$created_at = $this->created_at;
		$formattedDate = $created_at->format('d.m.Y') . ' г';

		return [
			'id' => $this->id,
			'product_id' => $this->product_id,
			'name' => $this->name,
			'rating' => $this->rating,
			'message' => $this->message,
			'like' => $this->formatNumber($this->like),
			'dislike' => $this->formatNumber($this->dislike),
			'data' => $formattedDate,
			'status' => is_null($this->deleted_at) ? 1 : 0,
		];
	}
}
