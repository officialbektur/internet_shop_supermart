<?php

namespace App\Http\Resources\Admin\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Project\Category;
use App\Models\Project\Commentary;
use App\Models\Project\Media;
use App\Models\Project\Specification;
use App\Http\Resources\NumberFormattingTrait;

use App\Http\Resources\Project\Tag\TagResource;

class ShowResource extends JsonResource
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

		$media = Media::whereIn('product_id', [$this->id])->orderBy('updated_at', 'desc')->get()->groupBy('product_id');

		// Получите все category_id из иерархии категорий
		$categoryHierarchy = $this->formatCategoryHierarchy($category);

		// Оптимизированный запрос для вычисления среднего рейтинга и округления его до одной десятой
		$averageRating = Commentary::where('product_id', $this->id)->avg('rating');
		$roundedRating = round($averageRating, 1);

		// Оптимизированный запрос для подсчета комментариев
		$commentariesCount = Commentary::where('product_id', $this->id)->count();

		// Преобразование чисел в укороченный формат
		$commentariesCountFormatted = $this->formatNumber($commentariesCount);

		$tags = TagResource::collection($this->tags);

		$specifications = Specification::with('parentRecursive')->get();

		$specificationsData = [];

		foreach ($this->specifications as $specification) {
			$parentId = $specification->parent_id;
			$specificationData = [
				'id' => $specification->id,
				'name' => $specification->name,
			];

			if (!isset($specificationsData[$parentId])) {
				$specificationsData[$parentId] = [
					'id' => $parentId,
					'name' => $specifications->where('id', $parentId)->value('name'),
					'data' => [],
				];
			}

			$specificationsData[$parentId]['data'][] = $specificationData;
		}

		$specificationsInfo = array_values($specificationsData);

		return [
			"id" => $this->id,
			"title" => $this->title,
			"media" => isset($media[$this->id]) ? \App\Http\Resources\Admin\Media\ShowResource::collection($media[$this->id]) : '',
			"media_count" => isset($media[$this->id]) ? count($media[$this->id]) : 0,
			"price_old" => $this->price_old,
			"price_now" => $this->price_now,
			"categories" => $categoryHierarchy,
			"discount" => $this->discount,
			"hit" => $this->hit,
			"rating" => $roundedRating,
			"tags" => $tags,
			"specifications" => $specificationsInfo,
			"commentaries" => $commentariesCountFormatted,
			"status" => is_null($this->deleted_at) ? 1 : 0,
		];
	}
	protected function formatCategoryHierarchy($category)
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