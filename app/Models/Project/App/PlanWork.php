<?php

namespace App\Models\Project\App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanWork extends Model
{
    use HasFactory;

	protected $table = 'plan_works';
	protected $guarded = false;
	protected $fillable = [];
}
