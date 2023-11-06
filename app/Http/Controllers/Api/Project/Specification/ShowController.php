<?php

namespace App\Http\Controllers\Api\Project\Specification;

use App\Http\Controllers\Controller;
use App\Models\Project\Product;
use App\Http\Resources\Project\Product\IndexResource;
use Illuminate\Http\Request;
use App\Models\Project\Specification;

class ShowController extends Controller
{
	public function __invoke($id)
	{
		$product = Product::find($id);
		$specifications = Specification::with('parentRecursive')->get();

		$specificationsData = [];

		foreach ($product->specifications as $specification) {
			$parentId = $specification->parent_id;
			$specificationData = [
				'id' => $specification->id,
				'name' => $specification->name,
			];

			if (!isset($specificationsData[$parentId])) {
				$specificationsData[$parentId] = [
					'id' => $parentId,
					'name' => $specifications->where('id', $parentId)->value('name'),
					'data' => [],
				];
			}

			$specificationsData[$parentId]['data'][] = $specificationData;
		}

		$specificationsInfo = array_values($specificationsData);

		return response()->json($specificationsInfo);
	}
}