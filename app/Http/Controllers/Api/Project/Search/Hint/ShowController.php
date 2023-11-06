<?php

namespace App\Http\Controllers\Api\Project\Search\Hint;

use App\Http\Controllers\Controller;

use App\Models\Project\SearchHint;
use App\Http\Resources\Project\Search\HintResource;

class ShowController extends Controller
{
	public function __invoke($id)
	{
		$hints = new HintResource(SearchHint::find($id));
		return response()->json($hints);
	}
}
