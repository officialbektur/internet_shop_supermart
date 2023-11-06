<?php

namespace App\Http\Controllers\Project\Product;

use App\Http\Controllers\Project\BaseController;
use Illuminate\Http\Request;

use App\Models\Project\Product;
use App\Models\Project\Category;
use App\Models\Project\Media;
use App\Models\Project\Commentary;
use App\Models\Project\Description;

use App\Http\Resources\NumberFormattingTrait;

class ShowController extends BaseController
{
	use NumberFormattingTrait;
    public function __invoke($id)
	{
		$aboutinfo = $this->aboutinfo();

		$product = Product::where('id', $id)->where('status', '1')->firstOrFail();

		$category = Category::with('parentRecursive')->find($product->category_id);
		$categories = $this->formatCategoryHierarchy($category);
		$commentary = Commentary::where('product_id', $id);
		$rating = round($commentary->avg('rating'), 1);
		$commentariesCount = $this->formatNumber($commentary->count());
		$media = Media::where('product_id', $id)->orderBy('updated_at', 'desc')->get();

		$product['rating'] = $rating;
		$product['categories'] = $categories;
		$product['media'] = $media;
		$product['commentaries'] = $commentariesCount;

		$description = Description::where('product_id', $id)->first();

		return view('project.show', compact(
											'aboutinfo',
											'product',
											'description',
										));
	}
}
