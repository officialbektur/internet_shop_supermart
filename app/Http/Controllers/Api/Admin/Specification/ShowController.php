<?php

namespace App\Http\Controllers\Api\Admin\Specification;

use App\Http\Controllers\Api\Admin\Specification\BaseController;
use App\Models\Project\Specification;
use Illuminate\Http\Request;

class ShowController extends BaseController {
	public function __invoke($specification)
    {
		$specification = Specification::with('parentRecursive')->find($specification);

		$specificationHierarchy = $this->formatSpecificationHierarchy($specification);

		return response()->json($specificationHierarchy);
	}
}