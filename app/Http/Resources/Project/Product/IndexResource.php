<?php

namespace App\Http\Resources\Project\Product;

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

		$media = $getMediaQuery->limit(4)->get()->groupBy('product_id');

		$mediaCount = $getMediaQuery->count();
		if (is_array($mediaCount)) {
			$imagesCount = $mediaCount[$this->id] ?? 0;
		} else {
			$imagesCount = 0;
		}
		// Получите все category_id из иерархии категорий
		$categoryHierarchy = $this->formatCategoryHierarchy($category);

		// Оптимизированный запрос для вычисления среднего рейтинга и округления его до одной десятой
		$averageRating = Commentary::where('product_id', $this->id)->avg('rating');
		$roundedRating = round($averageRating, 1);

		// Оптимизированный запрос для подсчета комментариев
		$commentariesCount = Commentary::where('product_id', $this->id)->count();

		// Преобразование чисел в укороченный формат
		$commentariesCountFormatted = $this->formatNumber($commentariesCount);

		return [
			"id" => $this->id,
			"title" => $this->title,
			"images" => isset($media[$this->id])
							? \App\Http\Resources\Project\Media\IndexResource::collection($media[$this->id])
							: [['src_average' => asset('storage/project/product/default/default.png')]],
			"images_count" => $mediaCount,
			"price_old" => $this->price_old,
			"price_now" => $this->price_now,
			"categories" => $categoryHierarchy,
			"discount" => $this->price_old == 0 ? 0 : 1,
			"hit" => (int) $this->hit,
			"rating" => $roundedRating,
			"commentaries" => $commentariesCountFormatted,
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
