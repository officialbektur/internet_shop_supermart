<?php

namespace App\Http\Resources\Admin\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Project\Category;
use App\Models\Project\Commentary;
use App\Models\Project\Media;

use App\Http\Resources\NumberFormattingTrait;

class IndexResource extends JsonResource
{
	use NumberFormattingTrait;
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		// Найдите категорию по ID вместе с родителями
		$category = Category::with('parentRecursive')->find($this->category_id);

		$getMediaQuery = Media::where('product_id', $this->id)->orderByDesc('updated_at');

		$media = $getMediaQuery->limit(1)->get()->groupBy('product_id');

		// Получите все category_id из иерархии категорий
		$categoryHierarchy = $this->formatCategoryHierarchy($category);

		// Оптимизированный запрос для подсчета комментариев
		$commentariesCount = Commentary::where('product_id', $this->id)->count();

		// Преобразование чисел в укороченный формат
		$commentariesCountFormatted = $this->formatNumber($commentariesCount);

		return [
			"id" => $this->id,
			"title" => $this->title,
			"image" => isset($media[$this->id])
							? new \App\Http\Resources\Project\Media\TrashResource($media[$this->id][0])
							: asset('storage/project/product/default/default.png'),
			"price_old" => $this->price_old,
			"price_now" => $this->price_now,
			"categories" => $categoryHierarchy,
			"commentaries" => $commentariesCountFormatted,
			"discount" => (int) $this->discount,
			"hit" => (int) $this->hit,
			"status" => is_null($this->deleted_at) ? 1 : 0,
		];
	}
	private function formatCategoryHierarchy($category)
	{
		$hierarchy = [];

		while ($category) {
			$hierarchy[] = [
				'id' => $category->id,
				'name' => $category->name,
			];

			$category = $category->parentRecursive;
		}

		return array_reverse($hierarchy);
	}

}
