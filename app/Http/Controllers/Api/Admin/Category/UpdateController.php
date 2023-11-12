<?php

namespace App\Http\Controllers\Api\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\UpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\Project\Category;

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
				DB::rollBack();
				return response()->json(['error' => 'Нельзя создавать категорию внутри самой себя.'], 404);
			}

			$category = Category::find($id);

			if (!isset($category)) {
				DB::rollBack();
				return response()->json(['error' => 'Такой категории не существует!'], 404);
			}



			$categoryChildren = Category::where('parent_id', $id);
			$categoryChildrenIds = $categoryChildren->pluck('id')->toArray();

			if (in_array($data['parent_id'], $categoryChildrenIds)) {
				// Если попытка создать категорию внутри самой себя, откатываем транзакцию и возвращаем ошибку.
				DB::rollBack();
				return response()->json(['error' => 'Нельзя создавать категорию внутри самой себя.'], 404);
			}

			$category->update($data);

			// Если все прошло успешно, фиксируем изменения и возвращаем успешное сообщение.
			DB::commit();

			return response()->json([
				'message' => 'Категория успешно отредактирована!'
			], 201);
		} catch (QueryException $exception) {
			DB::rollBack();

			return response()->json(['error' => 'Ошибка базы данных'], 500);
		} catch (\Exception $exception) {
			DB::rollBack();

			return response()->json(['error' => 'Ошибка сервера'], 500);
		}
	}
}
