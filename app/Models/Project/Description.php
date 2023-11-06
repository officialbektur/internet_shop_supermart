<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory;

	protected $table = 'descriptions';
	protected $guarded = false;
	protected $fillable = [];

}
