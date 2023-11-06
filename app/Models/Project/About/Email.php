<?php

namespace App\Models\Project\About;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

	protected $table = 'emails';
	protected $guarded = false;
	protected $fillable = [];
}
