<?php

namespace App\Http\Controllers\Api\Admin\Product;

use App\Http\Controllers\Controller;

use App\Models\Project\Product;

use App\Http\Resources\Admin\Product\ShowResource;

use Illuminate\Http\Request;

class ShowController extends Controller {
	public function __invoke($id)
	{
		$product = Product::withTrashed()->where('id', $id)->firstOrFail();

		$productResource = new ShowResource($product);

		return response()->json($productResource);
	}
}