<?php

namespace App\Http\Controllers\Api\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\Project\Category;

class DestroyController extends Controller
{
	public function __invoke($category)
	{
		try {
			$result = Category::find($category);

			if (!isset($result)) {
				DB::rollBack();
				return response()->json(['error' => 'Такого категории не существует!'], 404);
			}

			if ($result->products->isNotEmpty()) {
				return response()->json(['error' => 'Нельзя удалить категорию, пока у неё есть связанные товары!'], 400);
			}

			$result->delete();

			DB::commit();

			return response()->json([
				'message' => 'Категория успешно удалена!'
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
