<?php

namespace App\Http\Controllers\Api\Project\Commentary;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Project\Commentary;

use App\Http\Resources\Project\Commentary\IndexResource;

class CommentaryController extends Controller {
	public function __invoke($id)
	{
		$commentaries = Commentary::where('product_id', $id)->orderByDesc('created_at')->paginate(20);
		$commentariesResource = IndexResource::collection($commentaries);
		return response()->json($commentariesResource);
	}
}