<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
	use HasFactory;

	protected $table = 'product_tags';
	protected $guarded = false;
	protected $fillable = [];
}
