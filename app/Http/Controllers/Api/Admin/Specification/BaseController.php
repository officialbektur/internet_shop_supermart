<?php

namespace App\Http\Controllers\Api\Admin\Specification;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
	protected function formatSpecifications($specification)
	{
		$formatted = [
			'id' => $specification->id,
			'name' => $specification->name,
		];

		$children = [];

		foreach ($specification->childrenRecursive as $child) {
			$formattedChild = $this->formatSpecifications($child);
			$children[] = $formattedChild;
		}

		if (!empty($children)) {
			$formatted['children'] = $children;
		}

		return $formatted;
	}
	protected function formatSpecificationHierarchy($specification)
	{
		$hierarchy = [];

		while ($specification) {
			$hierarchy[] = [
				'id' => $specification->id,
				'name' => $specification->name,
			];

			$specification = $specification->parentRecursive;
		}

		return array_reverse($hierarchy);
	}
}