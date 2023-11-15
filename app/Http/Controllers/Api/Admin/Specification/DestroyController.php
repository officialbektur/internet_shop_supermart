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
			$result = Specification::withTrashed()->where('id', $specification)->first();

			if (!isset($result)) {
				DB::rollBack();
				return response()->json(['error' => 'Такой характеристики не существует!'], 404);
			}

			if ($result->categories->isNotEmpty()) {
				DB::rollBack();
				return response()->json(['error' => 'Нельзя удалить характеристику, пока у неё есть связанные категорий!'], 400);
			}

			if (is_null($result->deleted_at)) {
				$result->delete();
			} else {
				$result->restore();
			}

			DB::commit();

			$status = is_null($result->deleted_at) ? 1 : 0;
			$message = is_null($result->deleted_at) ?
						'Характеристика успешно востановленно!' :
						'Характеристика успешно удалена!';
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
