<?php

namespace App\Http\Controllers\Api\Admin\Specification;

use App\Http\Controllers\Api\Admin\Specification\BaseController;
use App\Models\Project\Specification;
use Illuminate\Http\Request;

class ChildrenController extends BaseController {
	public function __invoke()
	{
		$rootSpecifications = Specification::where('parent_id', 0)->get();

		$formattedSpecifications = [];

		foreach ($rootSpecifications as $specification) {
			$formattedSpecification = $this->formatSpecifications($specification);
			$formattedSpecifications[] = $formattedSpecification;
		}
		$formattedSpecifications = array_filter($formattedSpecifications, function ($specification) {
			return isset($specification['children']);
		});

		return response()->json($formattedSpecifications);
	}
}