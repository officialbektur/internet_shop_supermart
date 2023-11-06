<?php

namespace App\Http\Controllers\Api\Project\Specification;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Project\Specification;

class IndexController extends Controller {
	public function __invoke()
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