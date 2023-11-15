<?php

namespace App\Http\Controllers\Api\Admin\App\Telephone;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\App\Telephone\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

use App\Models\Project\App\Telephone;

class UpdateController extends Controller
{
	public function __invoke(UpdateRequest $request)
	{
		try {
			DB::beginTransaction();

			$data = $request->validated();

			$id = $data['id'];
			unset($data['id']);

			$telephone = Telephone::find($id);

			if (!isset($telephone)) {
				DB::rollBack();
				return response()->json(['error' => 'Такого номера не сушествует!'], 400);
			}

			$telephone->update($data);

			DB::commit();

			return response()->json([
				'message' => 'Номер успешно обновлен!'
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