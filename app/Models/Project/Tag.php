<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	use HasFactory;

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