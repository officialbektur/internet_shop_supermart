<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Filterable;

class Commentary extends Model
{
	use HasFactory, Filterable, SoftDeletes;

	protected $table = 'commentaries';
	protected $guarded = false;
	protected $fillable = [];

}
