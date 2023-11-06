<?php

namespace App\Http\Controllers\Api\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EditEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\EditEmailMail;
use Carbon\Carbon;

class EditEmailController extends Controller
{
	public function __invoke(Request $request)
	{
		$res = $request->validate([
			'etap' => 'required|integer'
		]);
		if ($request->etap == 1) {
			if (isset($request->forms['email'])) {
				$res = $request->validate([
					'forms.email' => 'required|email'
				]);
				$email = $request->forms['email'];
				$user = User::where('email', $email)->first();
				if (!isset($user)) {
					return response()->json(['error' => 'Нету такого пользователя!'], 439);
				}

				$code = '';
				for ($i = 0; $i < 4; $i++) {
					$code .= random_int(1, 9);
				}
				EditEmail::create([
					'email' => $email,
					'code' => $code
				]);
				$title = 'Код потверждение для измение Emaila';
				// Mail::to($email)->send(new EditEmailMail($title, $code));
				return response()->json(['message' => 'Код был отправелен на ваш Email: '. $email], 200);
			}
	   } else if ($request->etap == 2) {
			if (isset($request->forms['email']) && isset($request->forms['code'])) {
				$res = $request->validate([
					'forms.email' => 'required|email',
					'forms.code' => 'required|integer|digits:4',
				]);
				$email = $request->forms['email'];
				$code = $request->forms['code'];
				$user = EditEmail::where('email', $email)->where('status', '0')->where('created_at', '>=', Carbon::now()->subMinutes(15))->orderBy('created_at', 'DESC')->first();
				if (!isset($user)) {
					return response()->json(['error' => 'Нету такого пользователя!'], 200);
				}
				if ($user->code != $code) {
					return response()->json(['error' => 'Неверный код!'], 200);
				}
				return response()->json(['message' => 'Код был потвержден'], 200);
			}
	   } else if ($request->etap == 3) {
			if (isset($request->forms['email']) && isset($request->forms['code']) && isset($request->forms['email_new'])) {
				$res = $request->validate([
					'forms.email' => 'required|email',
					'forms.code' => 'required|integer|digits:4',
					'forms.email_new' => 'required|email'
				]);
				$email = $request->forms['email'];
				$code = $request->forms['code'];
				$email_new = $request->forms['email_new'];
				$user = EditEmail::where('email', $email)->where('status', '0')->where('code', $code)->where('created_at', '>=', Carbon::now()->subMinutes(15))->orderBy('created_at', 'DESC')->first();
				if (!isset($user)) {
					return response()->json(['error' => 'Нету такого запроса!'], 439);
				}
				$userNew = User::where('email', $email_new)->first();

				if (isset($userNew)) {
					return response()->json(['error' => 'Такой Email занят!'], 200);
				}

				$code_new = '';
				for ($i = 0; $i < 4; $i++) {
					$code_new .= random_int(1, 9);
				}

				$user->update([
					'email_new' => $email_new,
					'code_new' => $code_new
				]);
				$title = 'Код подтверждения для окончательного изменения Email';
				Mail::to($email_new)->send(new EditEmailMail($title, $code_new));
				return response()->json(['message' => 'Код был отправлен на ваш Email: '. $email_new], 200);
			}
	   } else if ($request->etap == 4) {
			if (isset($request->forms['email']) && isset($request->forms['code']) && isset($request->forms['email_new']) && isset($request->forms['code_new'])) {
				$res = $request->validate([
					'forms.email' => 'required|email',
					'forms.code' => 'required|integer|digits:4',
					'forms.email_new' => 'required|email',
					'forms.code_new' => 'required|integer|digits:4'
				]);
				$email = $request->forms['email'];
				$code = $request->forms['code'];
				$email_new = $request->forms['email_new'];
				$code_new = $request->forms['code_new'];

				$user = EditEmail::where('email', $email)->where('status', '0')->
				where('created_at', '>=', Carbon::now()->subMinutes(30))->
				where(function ($query) use ($code, $email_new) {$query->
					where('code', $code)->orWhere('email_new', $email_new);})->
				orderBy('created_at', 'DESC')->first();

				if (!isset($user)) {
					return response()->json(['error' => 'Нету такого запроса!'], 200);
				}
				if (isset($user) && isset($user->code_new) && $user->code_new != $code_new) {
					return response()->json(['error' => 'Неверный код!'], 200);
				}

				$user->update([
					'status' => '1'
				]);
				$userUpdateEmail = User::where('email', $email)->first();
				if (!isset($userUpdateEmail)) {
					return response()->json(['error' => 'Нету такого пользователя!'], 200);
				}

				$userEmailEdinstvennyi = User::where('email', $email_new)->first();

				if (isset($userEmailEdinstvennyi)) {
					return response()->json(['error' => 'Такой Email занят!'], 200);
				}

				$userUpdateEmail->update([
					'email' => $email_new
				]);

				$token = auth()->tokenById($userUpdateEmail->id);

				return response()->json([
					'access_token' => $token,
					'message' => 'Email был успешно изменено'
				], 200);
			}
	   }
	}
}
