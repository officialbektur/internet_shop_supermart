<?php

namespace App\Http\Controllers\Api\Project\About\Adress;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Project\About\Adress;
use App\Http\Resources\Project\About\Adress\AdressResource;

class IndexController extends Controller
{
    public function __invoke()
	{
		$adresses = AdressResource::collection(Adress::all());
		return response()->json($adresses);
	}
}
