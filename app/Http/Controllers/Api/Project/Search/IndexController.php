<?php

namespace App\Http\Controllers\Api\Project\Search;

use App\Http\Controllers\Controller;
use App\Models\Project\Product;

use Illuminate\Http\Request;

use App\Http\Resources\Project\Product\IndexResource;

use App\Http\Filters\ProductFilter;

class IndexController extends Controller
{
	public function __invoke(Request $request)
	{
		$data = $request->input();

		$fillter = app()->make(ProductFilter::class, ['queryParams' => array_filter($data)]);

		$products = Product::filter($fillter)->paginate(20);

		$productsResource = IndexResource::collection($products);

		$totalCount = $products->total();

		return response()->json([
			'data' => $productsResource,
			'total' => $totalCount,
		]);
	}
}
