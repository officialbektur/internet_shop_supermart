<?php

namespace App\Http\Controllers\Api\Admin\About;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\About\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

use App\Models\Project\About;

class UpdateController extends Controller
{
	public function __invoke(UpdateRequest $request)
	{
		try {
			DB::beginTransaction();

			$data = $request->validated();

			$about = About::latest()->first();

			if (isset($about)) {
				$about->update($data);
			} else {
				About::create($data);
			}

			DB::commit();

			$message = isset($about) ? 'Данные успешно обновлены!' : 'Данные успешно добавлены!';

			return response()->json([
				'message' => $message
			], 201);
		} catch (QueryException $exception) {
			DB::rollBack();

			return response()->json(['error' => $exception->getMessage()], 500);
			return response()->json(['error' => 'Ошибка со стороны БД'], 500);
		} catch (\Exception $exception) {
			DB::rollBack();

			return response()->json(['error' => 'Ошибка со стороны сервера'], 500);
		}
	}
}