<?php

namespace App\Http\Controllers\Api\Admin\Specification;

use App\Http\Controllers\Api\Project\Specification\BaseController;
use App\Models\Project\Specification;
use Illuminate\Http\Request;

class DeletesController extends BaseController {
	public function __invoke()
	{
		$rootSpecifications = Specification::onlyTrashed()->get();

		$formattedSpecifications = [];

		foreach ($rootSpecifications as $specification) {
			$formattedSpecification = $this->formatSpecificationHierarchy($specification);
		}

		return response()->json($formattedSpecifications);
	}
}