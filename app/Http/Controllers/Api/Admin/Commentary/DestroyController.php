<?php

namespace App\Http\Controllers\Api\Admin\Commentary;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\Project\Commentary;

class DestroyController extends Controller
{
	public function __invoke($commentary)
	{
		try {
			$result = Commentary::withTrashed()->where('id', $commentary)->first();

			if (!isset($result)) {
				DB::rollBack();
				return response()->json(['error' => 'Такой комментарий не существует'], 404);
			}
			if (is_null($result->deleted_at)) {
				$result->delete();
			} else {
				$result->restore();
			}

			DB::commit();

			$status = is_null($result->deleted_at) ? 1 : 0;
			$message = is_null($result->deleted_at) ?
						'Комментарий успешно востановленно!' :
						'Комментарий успешно удалена!';
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
