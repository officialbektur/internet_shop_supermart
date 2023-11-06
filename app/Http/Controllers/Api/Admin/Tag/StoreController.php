<?php

namespace App\Http\Controllers\Api\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\StoreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\Project\Tag;

class StoreController extends Controller
{
	public function __invoke(StoreRequest $request)
	{
		try {
			DB::beginTransaction();

			$data = $request->validated();

			$tag = Tag::where('name', $data['name'])->first();

			if (isset($tag)) {
				DB::rollBack();
				return response()->json(['error' => 'Такой тег уже сушествует'], 400);
			}

			$tagId = Tag::create($data);

			DB::commit();

			return response()->json([
				'message' => 'Тег было успешно созданно!'
			], 201);
		} catch (QueryException $exception) {
			DB::rollBack();

			return response()->json(['error' => 'Ошибка со стороны БД'], 500);
		} catch (\Exception $exception) {
			DB::rollBack();

			return response()->json(['error' => 'Ошибка со стороны сервера'], 500);
		}
	}
}
