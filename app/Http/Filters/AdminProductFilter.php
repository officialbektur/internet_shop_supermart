<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class AdminProductFilter extends AbstractFilter
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
				$this->isSearchProduct = true;
				$builder->orderBy('id', 'asc');
				break;
			case 2:
				$builder->orderByDesc('price_old');
				break;
			case 3:
				$builder->orderByDesc('hit');
				break;
			case 4:
				$builder->orderBy('id', 'desc');
				break;
			case 5:
				$builder->orderBy('price_now', 'asc');
				break;
			case 6:
				$builder->orderByDesc('price_now');
				break;
			case 7:
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
			$builder->where('id', $value);
		} else {
			$builder->orWhere(function ($query) use ($value) {
				$query->where('id', 'like', "%{$value}%")
					->orWhere('title', 'LIKE', "%{$value}%")
					->orWhereHas('tags', function ($subQuery) use ($value) {
						$subQuery->where('name', 'LIKE', "%{$value}%");
					})
					->orWhereHas('category', function ($subQuery) use ($value) {
						$subQuery->where('name', 'LIKE', "%{$value}%");
					})
					->orWhereHas('specifications', function ($subQuery) use ($value) {
						$subQuery->where('name', 'LIKE', "%{$value}%");
					})
					->orWhere('price_old', 'LIKE', "%{$value}%")
					->orWhere('price_now', 'LIKE', "%{$value}%");
			});
		}
	}
}
