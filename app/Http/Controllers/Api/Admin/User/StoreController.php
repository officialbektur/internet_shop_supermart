<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\User;

class StoreController extends Controller
{
	public function __invoke(StoreRequest $request)
	{
		try {
			DB::beginTransaction();

			$data = $request->validated();

			if (User::count() > 0) {
				DB::rollBack();
				return response()->json(['error' => 'В системе уже зарегистрирован пользователь. Новые регистрации не разрешены.'], 400);
			}

			$user = User::where('email', $data['email'])->first();

			if (isset($user)) {
				DB::rollBack();
				return response()->json(['error' => 'Пользователь с указанным Email уже зарегистрирован в системе.'], 400);
			}

			$data['password'] = Hash::make($data['password']);
			$user = User::create($data);
			$token = auth()->tokenById($user->id);

			DB::commit();

			return response()->json([
				'access_token' => $token,
				'message' => 'Успешный вход'
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
