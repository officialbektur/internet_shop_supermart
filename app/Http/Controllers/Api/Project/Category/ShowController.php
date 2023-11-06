<?php

namespace App\Http\Controllers\Api\Project\Category;

use App\Http\Controllers\Api\Project\Category\BaseController;
use App\Models\Project\Category;
use Illuminate\Http\Request;

class ShowController extends BaseController {
	public function __invoke($category)
    {
		$category = Category::with('parentRecursive')->find($category);

        $categoryHierarchy = $this->formatCategoryHierarchy($category);

        return response()->json($categoryHierarchy);
	}
}