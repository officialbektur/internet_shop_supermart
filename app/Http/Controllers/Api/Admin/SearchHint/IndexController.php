<?php

namespace App\Http\Controllers\Api\Admin\SearchHint;

use App\Http\Controllers\Controller;

use App\Models\Project\SearchHint;
use App\Http\Resources\Admin\Search\HintResource;

class IndexController extends Controller
{
    public function __invoke()
	{
		$hints = HintResource::collection(SearchHint::withTrashed()->orderByDesc('updated_at')->get());
		return response()->json($hints);
	}
}
