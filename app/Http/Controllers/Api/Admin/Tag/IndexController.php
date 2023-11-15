<?php

namespace App\Http\Controllers\Api\Admin\Tag;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\Project\Tag;

use App\Http\Resources\Admin\Tag\TagResource;

class IndexController extends Controller
{
	public function __invoke()
	{
		$tags = TagResource::collection(Tag::withTrashed()->get());
		return response()->json($tags);
	}
}
