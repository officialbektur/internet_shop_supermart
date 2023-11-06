<?php

namespace App\Http\Controllers\Project\Specification;

use App\Http\Controllers\Project\BaseController;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke()
	{
		$aboutinfo = $this->aboutinfo();
		return view('project.search', compact('aboutinfo'));
	}
}
