<?php

namespace App\Http\Controllers\Api\Project\Category;

use App\Http\Controllers\Api\Project\Category\BaseController;
use App\Models\Project\Category;
use App\Models\Project\Product;
use Illuminate\Http\Request;

use App\Http\Resources\Project\Product\IndexResource;

class CategoryProductController extends BaseController {
	public function __invoke($category)
	{
		// Найдите категорию по ID вместе с родителями
		// $category = Category::with('parentRecursive')->find($category);

		// Получите все category_id из иерархии категорий
		// $categoryIds = $this->getCategoryIdsFromHierarchy($category);

		// Найдите все статьи, связанные с этими категориями
		$products = Product::where('category_id', $category)->paginate(10);
		// $products = Product::whereIn('category_id', $categoryIds)->paginate(10);

		$productsResource = IndexResource::collection($products);

		$totalCount = $products->total();

		return response()->json([
			'data' => $productsResource,
			'total' => $totalCount,
		]);
	}
}
