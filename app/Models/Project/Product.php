<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use HasFactory, Filterable, SoftDeletes;

	protected $table = 'products';
	protected $guarded = false;
	protected $fillable = [];

	public function category()
	{
		return $this->belongsTo(Category::class, 'category_id', 'id');
	}
	public function descriptions()
	{
		return $this->hasMany(Description::class);
	}
	public function tags()
	{
		return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id');
	}
	public function specifications()
	{
		return $this->belongsToMany(Specification::class, 'product_specifications', 'product_id', 'specification_id');
	}
}
