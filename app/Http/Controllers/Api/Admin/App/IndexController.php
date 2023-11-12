<?php

namespace App\Http\Controllers\Api\Admin\App;

use App\Http\Controllers\Controller;

use App\Models\Project\About\Adress;
use App\Models\Project\About\Email;
use App\Models\Project\About\Telephone;
use App\Models\Project\About\PlanWork;
use App\Models\Project\About\Soc;

use App\Http\Resources\Admin\About\Adress\AdressResource;
use App\Http\Resources\Admin\About\Email\EmailResource;
use App\Http\Resources\Admin\About\Telephone\TelephoneResource;
use App\Http\Resources\Admin\About\PlanWork\PlanWorkResource;
use App\Http\Resources\Admin\About\Soc\SocResource;

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
