<?php

namespace App\Http\Controllers\Api\Admin\Commentary;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Project\Commentary;

use App\Http\Resources\Admin\Commentary\CommentaryResource;
use App\Http\Filters\AdminCommentaryFilter;

class IndexController extends Controller {
	public function __invoke(Request $request)
	{
		$data = $request->input();

		$fillter = app()->make(AdminCommentaryFilter::class, ['queryParams' => array_filter($data)]);

		$commentaries = Commentary::withTrashed()->filter($fillter)->paginate(20);
		$result = CommentaryResource::collection($commentaries);

		return response()->json($result);
	}
}