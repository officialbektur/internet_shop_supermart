<?php

namespace App\Http\Controllers\Api\Project\About;

use App\Http\Controllers\Controller;

use App\Http\Resources\Project\About\AboutResource;
use Illuminate\Http\Request;
use App\Models\Project\About;

class IndexController extends Controller
{
	public function __invoke()
	{
		$about = About::latest()->first();

		$aboutResource = new AboutResource($about);

		return response()->json($aboutResource);
	}
}