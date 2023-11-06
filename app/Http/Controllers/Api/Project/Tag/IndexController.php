<?php

namespace App\Http\Controllers\Api\Project\Tag;

use App\Http\Controllers\Controller;
use App\Models\Project\Tag;
use Illuminate\Http\Request;
use App\Http\Resources\Project\Tag\TagResource;


class IndexController extends Controller {
	public function __invoke()
	{
		$tags = TagResource::collection(Tag::all());
		return response()->json($tags);
	}
}