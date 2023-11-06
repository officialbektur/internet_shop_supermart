<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class AdminCommentaryFilter extends AbstractFilter
{
	private $isSearchProduct = false;
	public const q = 'q';
	public const sort = 'sort';

	protected function getCallbacks(): array
	{
		return [
			self::sort => [$this, 'sort'],
			self::q => [$this, 'q'],
		];
	}

	public function sort(Builder $builder, $value)
	{
		switch ($value) {
			case 0:
				$builder->orderBy('id', 'asc');
				break;
			case 1:
				$builder->orderBy('id', 'desc');
				break;
			case 2:
				$builder->orderBy('rating', 'desc');
				break;
			case 3:
				$builder->orderBy('rating', 'asc');
				break;
			case 4:
				$this->isSearchProduct = true;
				$builder->orderBy('id', 'asc');
				break;
			case 5:
				$builder->orderByDesc('deleted_at');
				break;
			default:
				$builder->orderBy('id', 'asc');
				break;
		}
	}

	public function q(Builder $builder, $value)
	{
		if ($this->isSearchProduct) {
			$builder->where('product_id', $value);
		} else {
			$builder->orWhere(function ($query) use ($value) {
				$query->where('id', 'like', "%{$value}%")
					->orWhere('rating', 'LIKE', "%{$value}%")
					->orWhere('name', 'LIKE', "%{$value}%")
					->orWhere('message', 'LIKE', "%{$value}%");
			});
		}
	}
}
