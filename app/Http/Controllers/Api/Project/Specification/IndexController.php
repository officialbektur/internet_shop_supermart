<?php

namespace App\Http\Controllers\Api\Project\Specification;

use App\Http\Controllers\Api\Project\Specification\BaseController;

use Illuminate\Http\Request;

use App\Models\Project\Specification;

class IndexController extends BaseController {
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
}