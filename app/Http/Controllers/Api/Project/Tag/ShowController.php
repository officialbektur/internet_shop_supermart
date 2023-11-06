<?php

namespace App\Http\Controllers\Api\Project\Tag;

use App\Http\Controllers\Controller;
use App\Models\Project\Tag;
use Illuminate\Http\Request;
use App\Http\Resources\Project\Tag\TagResource;

class ShowController extends Controller {
	public function __invoke($tag)
	{
		$result = new TagResource(Tag::find($tag));

		return response()->json($result);
	}
}