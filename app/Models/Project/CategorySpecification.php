<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySpecification extends Model
{
	use HasFactory;

	protected $table = 'category_specifications';
	protected $guarded = false;
	protected $fillable = [];

	public function specifications()
	{
		return $this->belongsToMany(Specification::class, 'product_specifications', 'specification_id', 'category_id');
	}
}