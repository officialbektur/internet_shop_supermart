<?php

namespace App\Http\Controllers\Api\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\EditPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordMail;
use Carbon\Carbon;
class EditPasswordController extends Controller
{
	public function __invoke(EditPasswordRequest $request)
	{
		$data = $request->validated();
		$user = User::find($data['id']);
		if (isset($user) && Hash::check($data['password_old'], $user->password)) {
			$hashedPassword = Hash::make($data['password_new']);
			$user->update(['password' => $hashedPassword]);
			$user->fresh();
			$token = auth()->tokenById($user->id);

			return response()->json(['message' => 'Пароль успешно изменен', 'access_token' => $token], 200);
		} else {
			return response()->json(['error' => 'Неверный пароль'], 200);
		}
	}
}
