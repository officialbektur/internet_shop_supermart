<?php

namespace App\Http\Controllers\Api\Admin\Product;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Resources\Admin\Product\IndexResource;

use App\Models\Project\Product;

use App\Http\Filters\AdminProductFilter;

class IndexController extends Controller {
	public function __invoke(Request $request)
	{
		$data = $request->input();

		$fillter = app()->make(AdminProductFilter::class, ['queryParams' => array_filter($data)]);

		$products = Product::withTrashed()->filter($fillter)->paginate(20);
		$result = IndexResource::collection($products);

		return response()->json($result);
	}
}