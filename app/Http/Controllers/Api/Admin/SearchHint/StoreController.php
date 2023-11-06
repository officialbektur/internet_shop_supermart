<?php

namespace App\Http\Controllers\Api\Admin\SearchHint;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SearchHint\StoreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\Project\SearchHint;

class StoreController extends Controller
{
	public function __invoke(StoreRequest $request)
	{
		try {
			DB::beginTransaction();

			$data = $request->validated();

			$searchhint = SearchHint::where('name', $data['name'])->first();

			if (is_null($searchhint)) {
				DB::rollBack();
				return response()->json(['error' => 'Такой рекомендация уже сушествует!'], 400);
			}

			$searchhintId = SearchHint::create($data);

			DB::commit();

			return response()->json([
				'message' => 'Рекомендация было успешно созданно!'
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
