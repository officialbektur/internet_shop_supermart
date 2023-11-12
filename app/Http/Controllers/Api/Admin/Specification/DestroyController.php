<?php

namespace App\Http\Controllers\Api\Admin\Specification;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\Project\Specification;

class DestroyController extends Controller
{
	public function __invoke($specification)
	{
		try {
			$result = Specification::find($specification);

			if (!isset($result)) {
				DB::rollBack();
				return response()->json(['error' => 'Такой характеристики не существует!'], 404);
			}

			if ($result->categories->isNotEmpty()) {
				DB::rollBack();
				return response()->json(['error' => 'Нельзя удалить характеристику, пока у неё есть связанные категорий!'], 400);
			}

			$result->delete();

			DB::commit();

			return response()->json([
				'message' => 'Характеристика успешно удалена!'
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
