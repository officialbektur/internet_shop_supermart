<?php

namespace App\Models\Project\About;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telephone extends Model
{
    use HasFactory;

	protected $table = 'telephones';
    protected $guarded = false;
    protected $fillable = [];
}
