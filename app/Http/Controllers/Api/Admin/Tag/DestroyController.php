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
			$result = Tag::withTrashed()->where('id', $tag)->first();

			if (!isset($result)) {
				DB::rollBack();
				return response()->json(['error' => 'Такого тега не существует'], 404);
			}

			if ($result->products->isNotEmpty()) {
				DB::rollBack();
				return response()->json(['error' => 'Нельзя удалить тег, пока у неё есть связанные товары'], 400);
			}

			if (is_null($result->deleted_at)) {
				$result->delete();
			} else {
				$result->restore();
			}

			DB::commit();

			$status = is_null($result->deleted_at) ? 1 : 0;
			$message = is_null($result->deleted_at) ?
						'Тег успешно востановленно!' :
						'Тег успешно удалена!';
			return response()->json([
				'status' => $status,
				'message' => $message
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
