<?php

namespace App\Http\Controllers\Api\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\Project\Category;

class StoreController extends Controller
{
	public function __invoke(StoreRequest $request)
	{
		try {
			DB::beginTransaction();

			$data = $request->validated();

			$category = Category::where('name', $data['name'])->where('parent_id', $data['parent_id'])->first();

			if (isset($category)) {
				DB::rollBack();
				return response()->json(['error' => 'Такой категорий уже сушествует!'], 400);
			}

			$categoryId = Category::create($data);

			DB::commit();

			return response()->json([
				'message' => 'Категорий было успешно созданно!'
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
