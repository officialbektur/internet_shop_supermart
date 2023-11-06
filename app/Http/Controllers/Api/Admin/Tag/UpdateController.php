<?php

namespace App\Http\Controllers\Api\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\UpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\Project\Tag;

class UpdateController extends Controller
{
	public function __invoke(UpdateRequest $request)
	{
		try {
			DB::beginTransaction();

			$data = $request->validated();

			$id = $data['id'];
			unset($data['id']);

			$tag = Tag::find($id);

			if (!isset($tag)) {
				DB::rollBack();
				return response()->json(['error' => 'Такого тега не сушествует'], 404);
			}

			$tag->update($data);

			DB::commit();

			return response()->json([
				'message' => 'Тег успешно отредактирован!'
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
