<?php

namespace App\Http\Controllers\Api\Project\Search\Hint;

use App\Http\Controllers\Controller;

use App\Models\Project\SearchHint;
use App\Http\Resources\Project\Search\HintResource;

class IndexController extends Controller
{
    public function __invoke()
	{
		$hints = HintResource::collection(SearchHint::orderBy('updated_at', 'asc')->get());
		return response()->json($hints);
	}
}
