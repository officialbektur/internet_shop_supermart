<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    use HasFactory;

	protected $table = 'specifications';
	protected $guarded = false;
	protected $fillable = [];

	public function parentRecursive()
	{
		return $this->belongsTo(Specification::class, 'parent_id')->with('parentRecursive');
	}

	public function childrenRecursive()
	{
		return $this->hasMany(Specification::class, 'parent_id')->with('childrenRecursive');
	}
	public function categories()
	{
		return $this->belongsToMany(Category::class, 'category_specifications', 'specification_id', 'category_id');
	}
}
