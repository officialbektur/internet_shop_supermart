<?php
namespace App\Http\Controllers\Api\Admin\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ResetPassword;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Carbon\Carbon;


class AuthController extends Controller
{
	/**
	 * Create a new AuthController instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth:api', ['except' => ['login', 'refresh']]);
	}

	/**
	 * Get a JWT via given credentials.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function login(Request $request)
	{
		$credentials = $request->only('email', 'password');

		// Проверяем, есть ли пользователь в users таблице с таким email
		$user = User::where('email', $credentials['email'])->first();
		if (isset($user) && Hash::check($credentials['password'], $user->password)) {
			return $this->respondWithToken(JWTAuth::fromUser($user), 'Успешный вход');
		}

		// Если пользователя нет в users таблице, проверяем ResetPassword
		$resetPassword = ResetPassword::where('email', $credentials['email'])
			->where('created_at', '>=', now()->subMinutes(10))
			->where('used', false)
			->first();

		if (isset($resetPassword) && Hash::check($credentials['password'], $resetPassword->password)) {
			$user = User::where('email', $credentials['email'])->first();
			$hashedPassword = Hash::make($credentials['password']);
			$user->update(['password' => $hashedPassword]);
			JWTAuth::invalidate(JWTAuth::fromUser($user));

			$resetPassword->update(['used' => true]);

			return $this->respondWithToken(JWTAuth::fromUser($user), 'Успешный вход');
		}
		if (!isset($user) && !isset($resetPassword)) {
			return response()->json(['error' => 'Неавторизованный E-mail!'], 401);
		}
		return response()->json(['error' => 'Неправильный пароль!'], 401);
	}


	/**
	 * Get the authenticated User.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function me()
	{
		return response()->json(auth()->user());
	}

	/**
	 * Get the authenticated User.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function status()
	{
		return response()->json([
			'status' => true
		]);
	}

	/**
	 * Log the user out (Invalidate the token).
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function logout()
	{
		auth()->logout();

		return response()->json(['message' => 'Вы успешно вышли из системы!']);
	}

	/**
	 * Refresh a token.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function refresh()
	{
		return $this->respondWithToken(auth()->refresh(), 'Успешный обновлен токен!');
	}

	/**
	 * Get the token array structure.
	 *
	 * @param  string $token
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function respondWithToken($token, $message = '')
	{
		$response = [
			'access_token' => $token,
			'token_type' => 'bearer',
			'expires_in' => auth()->factory()->getTTL() * 60,
		];

		if ($message) {
			$response['message'] = $message;
		}

		return response()->json($response);
	}
}