<?php

namespace App\Http\Controllers\Api\Admin\Specification;

use App\Http\Controllers\Controller;
use App\Models\Project\Specification;
use Illuminate\Http\Request;
use App\Http\Resources\Project\Specification\SpecificationResource;

class DeletesController extends Controller {
	public function __invoke()
	{
		$specifications = Specification::onlyTrashed()->get();
		$result = SpecificationResource::collection($specifications);

		return response()->json($result);
	}
}