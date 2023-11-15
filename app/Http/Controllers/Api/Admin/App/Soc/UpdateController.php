<?php

namespace App\Http\Controllers\Api\Admin\App\Soc;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\App\Soc\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

use App\Models\Project\App\Soc;

class UpdateController extends Controller
{
	public function __invoke(UpdateRequest $request)
	{
		try {
			DB::beginTransaction();

			$data = $request->validated();

			$id = $data['id'];
			unset($data['id']);

			$soc = Soc::find($id);

			if (!isset($soc)) {
				DB::rollBack();
				return response()->json(['error' => 'Такой соц. сети не сушествует!'], 400);
			}

			$soc->update($data);

			DB::commit();

			return response()->json([
				'message' => 'Соц. сеть успешно обновлен!'
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