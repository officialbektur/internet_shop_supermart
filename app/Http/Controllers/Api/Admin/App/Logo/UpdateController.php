<?php

namespace App\Http\Controllers\Api\Admin\App\Logo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\App\Logo\UpdateRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
	public function __invoke(UpdateRequest $request)
	{
		try {
			DB::beginTransaction();

			$data = $request->validated();

			$logo = $data['logo'];
			$image = Image::make($logo);

			$logoName = 'logo.png';

			$rootPath = 'project/logo/';

			// Сохранение src_max с использованием Storage::disk
			$logoPath = $rootPath . $logoName;
			Storage::disk('public')->put($logoPath, $image->stream());

			DB::commit();

			return response()->json([
				'message' => 'Логотип успешно обновлен!'
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