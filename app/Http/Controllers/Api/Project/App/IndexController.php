<?php

namespace App\Http\Controllers\Api\Project\App;

use App\Http\Controllers\Controller;

use App\Models\Project\About\Adress;
use App\Models\Project\About\Email;
use App\Models\Project\About\Telephone;
use App\Models\Project\About\PlanWork;
use App\Models\Project\About\Soc;

use App\Http\Resources\Project\About\Adress\AdressResource;
use App\Http\Resources\Project\About\Email\EmailResource;
use App\Http\Resources\Project\About\Telephone\TelephoneResource;
use App\Http\Resources\Project\About\PlanWork\PlanWorkResource;
use App\Http\Resources\Project\About\Soc\SocResource;

class IndexController extends Controller
{
	public function __invoke()
	{
		return response()->json($this->aboutinfo());
	}
	protected function aboutinfo()
	{
		return [
			'adresses' => AdressResource::collection(Adress::all()),
			'telephones' => TelephoneResource::collection(Telephone::all()),
			'emails' => EmailResource::collection(Email::all()),
			'plan_works' => new PlanWorkResource(PlanWork::first()),
			'socs' => SocResource::collection(Soc::all()),
		];
	}
}
