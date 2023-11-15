<?php

namespace App\Models\Project\App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adress extends Model
{
	use HasFactory;

	protected $table = 'adresses';
	protected $guarded = false;
	protected $fillable = [];
}
