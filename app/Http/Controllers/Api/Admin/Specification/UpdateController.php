<?php

namespace App\Http\Controllers\Api\Admin\Specification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Specification\UpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\Project\Specification;

class UpdateController extends Controller
{
	public function __invoke(UpdateRequest $request)
	{
		try {
			DB::beginTransaction();

			$data = $request->validated();

			$id = $data['id'];
			unset($data['id']);
			
			if ($id == $data['parent_id']) {
				// Если попытка создать категорию внутри самой себя, откатываем транзакцию и возвращаем ошибку.
				DB::rollBack();
				return response()->json(['error' => 'Нельзя создавать характеристику внутри самой себя.'], 404);
			}

			$specification = Specification::find($id);

			if (!isset($specification)) {
				// Если категория с заданным идентификатором не существует, откатываем транзакцию и возвращаем ошибку.
				DB::rollBack();
				return response()->json(['error' => 'Такой характеристики не сушествует'], 404);
			}


			$specificationChildren = Specification::where('parent_id', $id);
			$specificationChildrenIds = $specificationChildren->pluck('id')->toArray();

			if (in_array($data['parent_id'], $specificationChildrenIds)) {
				// Если попытка создать категорию внутри самой себя, откатываем транзакцию и возвращаем ошибку.
				DB::rollBack();
				return response()->json(['error' => 'Нельзя создавать характеристику внутри самой себя.'], 404);
			}

			$specification->update($data);

			DB::commit();

			return response()->json([
				'message' => 'Характеристика успешно отредактирован!'
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
