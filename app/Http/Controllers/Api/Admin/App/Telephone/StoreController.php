<?php

namespace App\Http\Controllers\Api\Admin\App\Telephone;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\App\Telephone\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

use App\Models\Project\App\Telephone;

class StoreController  extends Controller
{
	public function __invoke(StoreRequest $request)
	{
		try {
			DB::beginTransaction();

			$data = $request->validated();

			$telephone = Telephone::create($data);

			DB::commit();

			return response()->json([
				'id' => $telephone->id,
				'message' => 'Номер успешно создан!'
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