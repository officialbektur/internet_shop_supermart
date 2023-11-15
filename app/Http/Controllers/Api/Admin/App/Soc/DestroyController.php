<?php

namespace App\Http\Controllers\Api\Admin\App\Soc;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

use App\Models\Project\App\Soc;

class DestroyController extends Controller
{
	public function __invoke($soc)
	{
		try {
			$result = Soc::find($soc);

			if (!isset($result)) {
				DB::rollBack();
				return response()->json(['error' => 'Такой соц. сети не сушествует!'], 404);
			}

			$result->delete();

			DB::commit();

			return response()->json([
				'message' => 'Соц. сеть успешно удалена!'
			], 200);
		} catch (QueryException $exception) {
			DB::rollBack();

			return response()->json(['error' => 'Ошибка со стороны БД'], 500);
		} catch (\Exception $exception) {
			DB::rollBack();

			return response()->json(['error' => 'Ошибка со стороны сервера'], 500);
		}
	}
}
