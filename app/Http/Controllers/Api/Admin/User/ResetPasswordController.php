<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\ResetPasswordRequest;
use App\Models\User;
use App\Models\ResetPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordMail;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
	public function __invoke(ResetPasswordRequest $request)
	{
		$data = $request->validated();
		$user = User::where('email', $data['email'])->first();

		if (!isset($user)) {
			return response()->json(['error' => 'Пользователь не найден'], 404);
		}

		$recentResetPasswords = ResetPassword::where('email', $data['email'])->where('created_at', '>=', Carbon::now()->subMinutes(60));
		if ($recentResetPasswords->count() > 5) {
			return response()->json(['error' => 'Превышено ограничение на количество запросов. Пожалуйста, подождите и не спамьте.'], 429);
		}

		$newPassword = Str::random(12);
		$hashedPassword = Hash::make($newPassword);

		$resetPasswordEntry = ResetPassword::create([
			'email' => $data['email'],
			'password' => $hashedPassword,
		]);

		Mail::to($data['email'])->send(new ResetPasswordMail($newPassword));

		return response()->json(['message' => 'Новый пароль создан и отправлен на вашу почту'], 200);
	}
}
