<?php

namespace App\Http\Controllers\Api\Project\Product;

use App\Http\Controllers\Controller;

use App\Models\Project\Description;

use App\Http\Resources\Project\Product\DescriptionResource;

use Illuminate\Http\Request;

class DescriptionController extends Controller {
	public function __invoke($id)
	{
		$description = Description::where('product_id', $id)->firstOrFail();

		$descriptionResource = new DescriptionResource($description);

		return response()->json($descriptionResource);
	}
}