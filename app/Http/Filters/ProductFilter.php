<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
	private $isSearchProduct = false;

	public const q = 'q';
	public const CATEGORY_ID = 'category_id';
	public const PRICES = 'prices';
	public const SORT = 'sort';
	public const SPECIFICATIONS = 'specifications';

	protected function getCallbacks(): array
	{
		return [
			self::SORT => [$this, 'sort'],
			self::q => [$this, 'q'],
			self::CATEGORY_ID => [$this, 'categoryId'],
			self::PRICES => [$this, 'prices'],
			self::SPECIFICATIONS => [$this, 'specifications'],
		];
	}

	public function applyFilters(Builder $builder)
	{
		foreach ($this->filters as $key => $value) {
			if (method_exists($this, $key)) {
				$this->$key($builder, $value);
			}
		}
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


	public function categoryId(Builder $builder, $value)
	{
		$builder->where('category_id', $value);
	}
	public function prices(Builder $builder, $value)
	{
		if (isset($value['from']) && isset($value['to'])) {
			$fromPrice = $value['from'];
			$toPrice = $value['to'];
			$builder->whereBetween('price_now', [$fromPrice, $toPrice]);
		} elseif (isset($value['from'])) {
			$fromPrice = $value['from'];
			$builder->where('price_now', '>=', $fromPrice);
		} elseif (isset($value['to'])) {
			$toPrice = $value['to'];
			$builder->where('price_now', '<=', $toPrice);
		}
	}
	public function specifications(Builder $builder, $value)
	{
		$builder->whereHas('specifications', function ($subQuery) use ($value) {
			$array = json_decode($value, true);
			$subQuery->whereIn('specifications.id', $array);
		});
	}
}
