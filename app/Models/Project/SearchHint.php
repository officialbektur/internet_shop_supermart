<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SearchHint extends Model
{
    use HasFactory, SoftDeletes;

	protected $table = 'search_hints';
    protected $guarded = false;
    protected $fillable = [];
}
