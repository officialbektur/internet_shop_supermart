<?php

namespace App\Http\Controllers\Project\Product;

use App\Http\Controllers\Project\BaseController;
use Illuminate\Http\Request;



class TrashController extends BaseController
{
    public function __invoke()
	{
		$aboutinfo = $this->aboutinfo();
		return view('project.trash', compact('aboutinfo'));
	}
}
