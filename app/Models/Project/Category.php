<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use HasFactory;

	protected $table = 'categories';
	protected $guarded = false;
	protected $fillable = [];

	public function parentRecursive()
	{
		return $this->belongsTo(Category::class, 'parent_id')->with('parentRecursive');
	}

	public function childrenRecursive()
	{
		return $this->hasMany(Category::class, 'parent_id')->with('childrenRecursive');
	}

	public function products()
	{
		return $this->hasMany(Product::class, 'category_id');
	}

	public function specifications()
	{
		return $this->belongsToMany(Specification::class, 'category_specifications', 'category_id', 'specification_id');
	}
}