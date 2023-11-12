<?php

namespace App\Http\Controllers\Api\Admin\App\Adress;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\App\Adress\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

use App\Models\Project\About\Adress;

class UpdateController extends Controller
{
	public function __invoke(UpdateRequest $request)
	{
		try {
			DB::beginTransaction();

			$data = $request->validated();

			$id = $data['id'];
			unset($data['id']);

			$adress = Adress::find($id);

			if (!isset($adress)) {
				DB::rollBack();
				return response()->json(['error' => 'Такого адресса не сушествует!'], 400);
			}

			$adress->update($data);

			DB::commit();

			return response()->json([
				'message' => 'Адресс успешно обновлен!'
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