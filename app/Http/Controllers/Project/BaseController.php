<?php

namespace App\Http\Controllers\Project;


use App\Http\Controllers\Controller;

use App\Models\Project\App\Adress;
use App\Models\Project\App\Email;
use App\Models\Project\App\Telephone;
use App\Models\Project\App\PlanWork;
use App\Models\Project\App\Soc;

use App\Http\Resources\Project\App\Adress\AdressResource;
use App\Http\Resources\Project\App\Email\EmailResource;
use App\Http\Resources\Project\App\Telephone\TelephoneResource;
use App\Http\Resources\Project\App\PlanWork\PlanWorkResource;
use App\Http\Resources\Project\App\Soc\SocResource;

class BaseController extends Controller
{
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
	protected function formatCategoryHierarchy($category)
	{
		$hierarchy = [];

		while ($category) {
			$hierarchy[] = [
				'id' => $category->id,
				'name' => $category->name,
			];

			$category = $category->parentRecursive;
		}

		return array_reverse($hierarchy);
	}
}
