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
			$result = Category::withTrashed()->where('id', $category)->first();

			if (!isset($result)) {
				DB::rollBack();
				return response()->json(['error' => 'Такой категории не существует!'], 404);
			}

			if ($result->products->isNotEmpty()) {
				DB::rollBack();
				return response()->json(['error' => 'Нельзя удалить категорию, пока у неё есть связанные товары!'], 400);
			}

			if ($result->specifications->isNotEmpty()) {
				DB::rollBack();
				return response()->json(['error' => 'Нельзя удалить категорию, пока у неё есть связанные характеристики!'], 400);
			}

			if (is_null($result->deleted_at)) {
				$result->delete();
			} else {
				$result->restore();
			}

			DB::commit();

			$status = is_null($result->deleted_at) ? 1 : 0;
			$message = is_null($result->deleted_at) ?
						'Категория успешно востановленно!' :
						'Категория успешно удалена!';
			return response()->json([
				'status' => $status,
				'message' => $message
			], 200);
		} catch (QueryException $exception) {
			DB::rollBack();

			return response()->json(['error' => $exception->getMessage()], 500);
		} catch (\Exception $exception) {
			DB::rollBack();

			return response()->json(['error' => 'Ошибка со стороны сервера'], 500);
		}
	}
}
