<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class UsersCountController extends Controller
{
	public function __invoke()
	{
		$usersCount = User::count();
		return response()->json(['status' => $usersCount > 0 ? 1 : 0], 200);
	}
}
