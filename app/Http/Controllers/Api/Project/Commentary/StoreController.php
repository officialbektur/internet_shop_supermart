<?php

namespace App\Http\Controllers\Api\Project\Commentary;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\Commentary\StoreRequest;
use App\Models\Project\Commentary;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Http\Resources\Project\Commentary\IndexResource;

class StoreController extends Controller
{
	public function __invoke(StoreRequest $request)
	{
		try {
			DB::beginTransaction();

			$data = $request->validated();

			$commentary = Commentary::create($data);

			DB::commit();

			$commentaryResource = new IndexResource($commentary);

			return response()->json([$commentaryResource], 201);
		} catch (QueryException $exception) {
			DB::rollBack();

			return response()->json(['error' => 'Ошибка со стороны БД'], 500);
		} catch (\Exception $exception) {
			DB::rollBack();

			return response()->json(['error' => 'Ошибка со стороны сервера'], 500);
		}
	}
}