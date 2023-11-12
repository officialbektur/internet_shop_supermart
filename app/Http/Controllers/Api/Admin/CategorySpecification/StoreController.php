<?php

namespace App\Http\Controllers\Api\Admin\CategorySpecification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategorySpecification\StoreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\Project\CategorySpecification;

use App\Models\Project\Category;
use App\Models\Project\Specification;

class StoreController extends Controller
{
	public function __invoke(StoreRequest $request)
	{
		try {
			DB::beginTransaction();

			$data = $request->validated();

			$category = Category::find($data['category_id']);

			if (!isset($category)) {
				DB::rollBack();
				return response()->json(['error' => 'Такой категории не существует!'], 404);
			}

			$specificationIds = $data['specification_ids'];

			$specificationCreateIds = [];
			for ($index=0; $index < count($specificationIds); $index++) {
				if (in_array($specificationIds[$index], $category->specifications->pluck('id')->toArray()) === false) {
					$specificationCreateIds[] = $specificationIds[$index];
				}
			}

			// Проверка наличия характеристик
			$existingSpecifications = Specification::whereIn('id', $specificationIds)->get();

			// Проверка, что все характеристики существуют
			if (count($existingSpecifications) !== count($specificationIds)) {
				DB::rollBack();
				return response()->json(['error' => 'Такой характеристики не существует!'], 400);
			}

			// Проверка, что ни одна характеристика не имеет parent_id равное 0
			if ($existingSpecifications->contains('parent_id', 0)) {
				DB::rollBack();
				return response()->json(['error' => 'Нельзя выбирать родительскую характеристику!'], 400);
			}

			if (count($specificationCreateIds) > 0) {
				// Добавление характеристик к категории
				$category->specifications()->attach($specificationCreateIds);
			}

			// Обновляем характеристик к категории
			$category->specifications()->sync($specificationIds);

			DB::commit();

			return response()->json([
				'message' => 'Успешно было связано!'
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