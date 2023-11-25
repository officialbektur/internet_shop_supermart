<?php

namespace App\Http\Controllers\Api\Project\Category;

use App\Http\Controllers\Api\Project\Category\BaseController;
use App\Models\Project\Category;
use App\Models\Project\Product;
use Illuminate\Http\Request;

use App\Http\Resources\Project\Product\IndexResource;

class RecController extends BaseController {
	public function __invoke($category)
	{
		// Найдите категорию по ID вместе с родителями
		$category = Category::with('parentRecursive')->find($category);

		// Получите все category_id из иерархии категорий
		$categoryIds = $this->getCategoryIdsFromHierarchy($category);

		// Найдите все статьи, связанные с этими категориями
		$products = Product::whereIn('category_id', $categoryIds)->get();

		$additionalProductsCount = 12 - count($products);

		if ($additionalProductsCount > 0) {
			// Если товаров меньше 12, добавляем дополнительные товары
			$additionalProducts = Product::whereNotIn('id', $products->pluck('id')->toArray())
				->take($additionalProductsCount)
				->get();

			$products = $products->concat($additionalProducts);
		}

		$products = $products->take(12);

		$productsResource = IndexResource::collection($products);

		return response()->json([
			'data' => $productsResource,
		]);
	}
}
