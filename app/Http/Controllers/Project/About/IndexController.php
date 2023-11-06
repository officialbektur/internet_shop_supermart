<?php

namespace App\Http\Controllers\Project\About;

use App\Http\Controllers\Project\BaseController;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke()
	{
		$aboutinfo = $this->aboutinfo();
		return view('project.about', compact('aboutinfo'));
	}
}
