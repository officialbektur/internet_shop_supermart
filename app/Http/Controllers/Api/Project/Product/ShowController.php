<?php

namespace App\Http\Controllers\Api\Project\Product;

use App\Http\Controllers\Controller;

use App\Models\Project\Product;

use App\Http\Resources\Project\Product\ShowResource;

use Illuminate\Http\Request;

class ShowController extends Controller {
	public function __invoke($id)
    {
		$product = Product::where('id', $id)->firstOrFail();

		$productResource = new ShowResource($product);

		return response()->json($productResource);
	}
}