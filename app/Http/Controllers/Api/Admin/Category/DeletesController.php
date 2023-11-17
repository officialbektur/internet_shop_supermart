<?php

namespace App\Http\Controllers\Api\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Project\Category;
use Illuminate\Http\Request;
use App\Http\Resources\Project\Category\CategoryResource;

class DeletesController extends Controller {
	public function __invoke()
	{
		$categories = Category::onlyTrashed()->get();

		$result = CategoryResource::collection($categories);

		return response()->json($result);
	}
}