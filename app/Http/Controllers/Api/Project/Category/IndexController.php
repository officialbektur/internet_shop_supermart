<?php

namespace App\Http\Controllers\Api\Project\Category;

use App\Http\Controllers\Api\Project\Category\BaseController;
use App\Models\Project\Category;
use Illuminate\Http\Request;

class IndexController extends BaseController {
	public function __invoke()
	{
		$rootCategories = Category::with('childrenRecursive')->where('parent_id', 0)->get();

		$formattedCategories = [];

		foreach ($rootCategories as $category) {
			$formattedCategory = $this->formatCategories($category);
			$formattedCategories[] = $formattedCategory;
		}

		return response()->json($formattedCategories);
	}
}