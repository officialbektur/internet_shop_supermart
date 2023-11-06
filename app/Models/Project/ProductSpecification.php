<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSpecification extends Model
{
	use HasFactory;

	protected $table = 'product_specifications';
	protected $guarded = false;
	protected $fillable = [];
}
