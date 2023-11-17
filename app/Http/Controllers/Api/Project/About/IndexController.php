<?php

namespace App\Http\Controllers\Api\Project\About;

use App\Http\Controllers\Controller;

use App\Http\Resources\Project\About\AboutResource;
use App\Models\Project\About;

class IndexController extends Controller
{
	public function __invoke()
	{
		$about = About::latest()->first();

		if (!isset($about)) {
			return response()->json(['error' => 'Данных нет!'], 404);
		}

		$aboutResource = new AboutResource($about);

		return response()->json($aboutResource);
	}
}