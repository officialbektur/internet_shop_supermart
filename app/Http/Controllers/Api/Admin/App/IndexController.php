<?php

namespace App\Http\Controllers\Api\Admin\App;

use App\Http\Controllers\Controller;

use App\Models\Project\App\Adress;
use App\Models\Project\App\Email;
use App\Models\Project\App\Telephone;
use App\Models\Project\App\PlanWork;
use App\Models\Project\App\Soc;

use App\Http\Resources\Admin\App\Adress\AdressResource;
use App\Http\Resources\Admin\App\Email\EmailResource;
use App\Http\Resources\Admin\App\Telephone\TelephoneResource;
use App\Http\Resources\Admin\App\PlanWork\PlanWorkResource;
use App\Http\Resources\Admin\App\Soc\SocResource;

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
