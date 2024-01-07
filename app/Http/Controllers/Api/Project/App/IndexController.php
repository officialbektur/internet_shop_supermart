<?php

namespace App\Http\Controllers\Api\Project\App;

use App\Http\Controllers\Controller;

use App\Models\Project\App\Adress;
use App\Models\Project\App\Email;
use App\Models\Project\App\Telephone;
use App\Models\Project\App\PlanWork;
use App\Models\Project\App\Soc;

class IndexController extends Controller
{
	public function __invoke()
	{
		return response()->json($this->aboutinfo());
	}
	protected function aboutinfo()
	{
		return [
            'adresses' => \App\Http\Resources\Project\App\Adress\AdressResource::collection(Adress::all()),
            'telephones' => \App\Http\Resources\Project\App\Telephone\TelephoneResource::collection(Telephone::all()),
            'emails' => \App\Http\Resources\Project\App\Email\EmailResource::collection(Email::all()),
            'plan_works' => PlanWork::first() ? \App\Http\Resources\Project\App\PlanWork\PlanWorkResource::make(PlanWork::latest()->first()) : [],
            'socs' => \App\Http\Resources\Project\App\Soc\SocResource::collection(Soc::all()),
		];
	}
}
