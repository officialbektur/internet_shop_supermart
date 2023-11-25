<?php

namespace App\Http\Controllers\Api\Project\Product;

use App\Http\Controllers\Controller;

use App\Models\Project\Product;

use App\Http\Requests\Project\Product\StoreRequest;

use App\Http\Resources\Project\Product\TrashResource;

use Illuminate\Http\Request;

class TrashController extends Controller {
	public function __invoke(StoreRequest $request)
	{
		$data = $request->validated();

		$products = Product::whereIn('id', $data['productIds'])->paginate(20);
		$productsResource = TrashResource::collection($products);

		$totalCount = $products->total();

		return response()->json([
			'data' => $productsResource,
			'total' => $totalCount,
		]);
	}
}