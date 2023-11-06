<?php

namespace App\Http\Controllers\Api\Project\Category;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
	protected function formatCategories($category)
	{
		$formatted = [
			'id' => $category->id,
			'name' => $category->name,
		];

		$children = [];

		foreach ($category->childrenRecursive as $child) {
			$formattedChild = $this->formatCategories($child);
			$children[] = $formattedChild;
		}

		if (!empty($children)) {
			$formatted['children'] = $children;
		}

		return $formatted;
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
	protected function getCategoryIdsFromHierarchy($category)
	{
		$categoryIds = [$category->id];
		$parentCategory = $category->parentRecursive;
		while ($parentCategory) {
			$categoryIds[] = $parentCategory->id;
			$parentCategory = $parentCategory->parentRecursive;
		}

		return $categoryIds;
	}
}