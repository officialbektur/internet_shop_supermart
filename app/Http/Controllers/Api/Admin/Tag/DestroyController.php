<?php

namespace App\Http\Controllers\Api\Admin\Tag;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\Project\Tag;

class DestroyController extends Controller
{
	public function __invoke($tag)
	{
		try {
			$result = Tag::find($tag);

			if (!isset($result)) {
				DB::rollBack();
				return response()->json(['error' => 'Такого тега не существует'], 404);
			}

			if ($result->products->isNotEmpty()) {
				return response()->json(['error' => 'Нельзя удалить тег, пока у неё есть связанные товары'], 400);
			}

			$result->delete();

			DB::commit();

			return response()->json([
				'message' => 'Тег успешно удалена!'
			], 200);
		} catch (QueryException $exception) {
			DB::rollBack();

			return response()->json(['error' => 'Ошибка со стороны БД'], 500);
		} catch (\Exception $exception) {
			DB::rollBack();

			return response()->json(['error' => 'Ошибка со стороны сервера'], 500);
		}
	}
}
