<?php

namespace App\Http\Controllers\Api\Admin\SearchHint;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\Project\SearchHint;

class DestroyController extends Controller
{
	public function __invoke($id)
	{
		try {
			$result = SearchHint::find($id);

			if (!is_null($result)) {
				DB::rollBack();
				return response()->json(['error' => 'Такого рекомендации не существует!'], 404);
			}

			$result->delete();

			DB::commit();

			return response()->json([
				'message' => 'Рекомендация успешно удалена!'
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
