<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchHint extends Model
{
    use HasFactory;

	protected $table = 'search_hints';
    protected $guarded = false;
    protected $fillable = [];
}
