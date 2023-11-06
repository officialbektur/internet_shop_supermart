<?php

namespace App\Http\Controllers\Api\Admin\CategorySpecification;

use App\Http\Controllers\Controller;

use App\Models\Project\Category;
use App\Models\Project\Specification;

use Illuminate\Http\Request;

class LinkController extends Controller
{
	public function __invoke($id)
	{
		$category = Category::find($id);

		if (!isset($category)) {
			return response()->json(['error' => 'Такой категории не существует!'], 404);
		}

		$specifications = Specification::with('parentRecursive')->get();

		$specificationsData = [];

		foreach ($category->specifications as $specification) {
			$parentId = $specification->parent_id;
			$specificationData = [
				'id' => $specification->id,
				'name' => $specification->name,
			];

			if (!isset($specificationsData[$parentId])) {
				$specificationsData[$parentId] = [
					'id' => $parentId,
					'name' => $specifications->where('id', $parentId)->value('name'),
					'children' => [],
				];
			}

			$specificationsData[$parentId]['children'][] = $specificationData;
		}

		$specificationsInfo = array_values($specificationsData);

		return response()->json($specificationsInfo);
	}
}