<?php

namespace App\Http\Controllers\Api\Admin\App\Email;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

use App\Models\Project\App\Email;

class DestroyController extends Controller
{
	public function __invoke($email)
	{
		try {
			$result = Email::find($email);

			if (!isset($result)) {
				DB::rollBack();
				return response()->json(['error' => 'Такого emaila не сушествует!'], 404);
			}

			$result->delete();

			DB::commit();

			return response()->json([
				'message' => 'Email успешно удалена!'
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
