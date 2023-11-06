<?php

namespace App\Http\Controllers\Api\Project\Product;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Project\Product;
use App\Http\Resources\Project\Product\IndexResource;

use App\Http\Filters\ProductFilter;

class SearchController extends Controller {
	public function __invoke(Request $request)
	{
		$data = $request->input();

		$fillter = app()->make(ProductFilter::class, ['queryParams' => array_filter($data)]);

		$products = Product::filter($fillter)->paginate(20);

		$result = IndexResource::collection($products);

		return response()->json($result);
	}
}