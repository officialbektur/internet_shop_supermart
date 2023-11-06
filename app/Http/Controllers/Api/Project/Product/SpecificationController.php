<?php

namespace App\Http\Controllers\Api\Project\Product;

use App\Http\Controllers\Controller;

use App\Models\Project\Product;

use App\Http\Resources\Project\Product\IndexResource;

use Illuminate\Http\Request;

use App\Models\Project\Specification;

class SpecificationController extends Controller {
	public function __invoke($id)
	{
		$rootSpecifications = Specification::with('childrenRecursive')->where('parent_id', 0)->get();

		$formattedSpecifications = [];

		foreach ($rootSpecifications as $specification) {
			$formattedSpecification = $this->formatSpecifications($specification);
			$formattedSpecifications[] = $formattedSpecification;
		}

		return response()->json($formattedSpecifications);
	}
	protected function formatSpecifications($specification)
	{
		$formatted = [
			'id' => $specification->id,
			'name' => $specification->name,
		];

		$children = [];

		foreach ($specification->childrenRecursive as $child) {
			$formattedChild = $this->formatSpecifications($child);
			$children[] = $formattedChild;
		}

		if (!empty($children)) {
			$formatted['children'] = $children;
		}

		return $formatted;
	}
}