<?php

namespace App\Http\Controllers\Api\Admin\Specification;

use App\Http\Controllers\Api\Admin\Specification\BaseController;
use App\Models\Project\Specification;
use Illuminate\Http\Request;

class IndexController extends BaseController {
	public function __invoke()
	{
		$rootSpecifications = Specification::where('parent_id', 0)->get();

		$formattedSpecifications = [];

		foreach ($rootSpecifications as $specification) {
			$formattedSpecification = $this->formatSpecifications($specification);
			$formattedSpecifications[] = $formattedSpecification;
		}

		return response()->json($formattedSpecifications);
	}
}