<?php

namespace App\Models\Project\App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soc extends Model
{
    use HasFactory;

	protected $table = 'socs';
	protected $guarded = false;
	protected $fillable = [];
}
