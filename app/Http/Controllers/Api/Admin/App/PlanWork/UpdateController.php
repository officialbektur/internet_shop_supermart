<?php

namespace App\Http\Controllers\Api\Admin\App\PlanWork;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\App\PlanWork\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

use App\Models\Project\App\PlanWork;

class UpdateController extends Controller
{
	public function __invoke(UpdateRequest $request)
	{
		try {
			DB::beginTransaction();

			$data = $request->validated();

			$id = $data['id'];
			unset($data['id']);

			$plan_works = PlanWork::find($id);

			if (!isset($plan_works)) {
				DB::rollBack();
				return response()->json(['error' => 'Такой график не сушествует!'], 400);
			}

			$plan_works->update($data);

			DB::commit();

			return response()->json([
				'message' => 'График успешно обновлен!'
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