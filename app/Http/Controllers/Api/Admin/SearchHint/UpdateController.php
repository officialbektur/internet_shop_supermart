<?php

namespace App\Http\Controllers\Api\Admin\SearchHint;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SearchHint\UpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\Project\SearchHint;

class UpdateController extends Controller
{
	public function __invoke(UpdateRequest $request)
	{
		try {
			DB::beginTransaction();

			$data = $request->validated();

			$id = $data['id'];
			unset($data['id']);

			$searchhint = SearchHint::find($id);

			if (!is_null($searchhint)) {
				DB::rollBack();
				return response()->json(['error' => 'Такой рекомендаций не сушествует!'], 404);
			}

			$searchhint->update($data);

			DB::commit();

			return response()->json([
				'message' => 'Рекомендация успешно отредактирован!'
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
