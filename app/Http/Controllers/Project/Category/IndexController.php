<?php

namespace App\Http\Controllers\Project\Category;

use App\Http\Controllers\Project\BaseController;

use Illuminate\Http\Request;

use App\Models\Project\Category;



class IndexController extends BaseController
{
    public function __invoke($category)
	{
		$aboutinfo = $this->aboutinfo();

		$category = Category::with('parentRecursive')->findOrFail($category);

        $categories = $this->formatCategoryHierarchy($category);

		return view('project.category', compact('aboutinfo', 'categories'));
	}

	protected function formatCategoryHierarchy($category)
	{
		$hierarchy = [];

		while ($category) {
			$hierarchy[] = [
				'id' => $category->id,
				'name' => $category->name,
			];

			$category = $category->parentRecursive;
		}

		return array_reverse($hierarchy);
	}
}
