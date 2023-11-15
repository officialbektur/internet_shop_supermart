<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
	use HasFactory, SoftDeletes;

	protected $table = 'tags';
	protected $guarded = false;
	protected $fillable = [];

	/**
	 * The roles that belong to the Product
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function products()
	{
		return $this->belongsToMany(Product::class, 'product_tags', 'tag_id', 'product_id');
	}
}