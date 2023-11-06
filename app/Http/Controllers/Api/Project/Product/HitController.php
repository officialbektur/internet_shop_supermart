<?php

namespace App\Http\Controllers\Api\Project\Product;

use App\Http\Controllers\Controller;

use App\Models\Project\Product;

use App\Http\Resources\Project\Product\IndexResource;

use Illuminate\Http\Request;

class HitController extends Controller {
	public function __invoke()
	{
		$products = Product::where('hit', 1)->paginate(20);
		$productsResource = IndexResource::collection($products);
		return response()->json($productsResource);
	}
}