<?php

namespace App\Http\Controllers\Api\Admin\Specification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\Specification\StoreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\Project\Specification;

class StoreController extends Controller
{
	public function __invoke(StoreRequest $request)
	{
		try {
			DB::beginTransaction();

			$data = $request->validated();

			$specification = Specification::where('name', $data['name'])->where('parent_id', $data['parent_id'])->first();

			if (isset($specification)) {
				DB::rollBack();
				return response()->json(['error' => 'Такой характеристики уже сушествует'], 400);
			}

			$specificationId = Specification::create($data);

			DB::commit();

			return response()->json([
				'message' => 'Характеристика было успешно созданно!'
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
