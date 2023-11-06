<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Project\About\Adress;
use App\Models\Project\About\Email;
use App\Models\Project\About\PlanWork;
use App\Models\Project\About\Soc;
use App\Models\Project\About\Telephone;
use App\Models\Project\Category;
use App\Models\Project\Tag;
use App\Models\Project\Product;
use App\Models\Project\Description;
use App\Models\Project\Media;
use App\Models\Project\Commentary;
use App\Models\Project\SearchHint;
use App\Models\Project\Specification;

class DatabaseSeeder extends Seeder
{
	public function run(): void
	{
		DB::beginTransaction();

		try {
			$password = Hash::make(123456789);
			User::create([
				'email' => 'akylbekuulubektur002@gmail.com',
				'password' => $password,
			]);


			Adress::factory(3)->create();
			Email::factory(3)->create();
			PlanWork::factory(1)->create();
			Soc::factory(3)->create();
			Telephone::factory(3)->create();


			$categories = Category::factory(100)->create();

			$specifications = Specification::factory(30)->create();
			$filteredSpecifications = Specification::where('parent_id', '!=', 0);

			foreach ($categories as $category) {
				$randomInt = random_int(1,30);

				$specificationIds = $filteredSpecifications->inRandomOrder()->take($randomInt)->pluck('id');
				$category->specifications()->attach($specificationIds);
			}

			$products = Product::factory(100)->create();
			$tags = Tag::factory(100)->create();
			$products = Product::all();
			$specifications = Specification::with('parentRecursive')->get();

			foreach ($products as $product) {
				$randomInt = random_int(1,5);

				$tagIds = $tags->random($randomInt)->pluck('id');
				$product->tags()->attach($tagIds);

				$categoryId = $product->category_id;;
				$category = Category::find($categoryId);


				$specificationsData = [];

				foreach ($category->specifications as $specification) {
					$parentId = $specification->parent_id;
					$specificationData = [
						'id' => $specification->id,
						'name' => $specification->name,
					];

					if (!isset($specificationsData[$parentId])) {
						$specificationsData[$parentId] = [
							'id' => $parentId,
							'name' => $specifications->where('id', $parentId)->value('name'),
							'children' => [],
						];
					}

					$specificationsData[$parentId]['children'][] = $specificationData;
				}

				$specificationsInfo = array_values($specificationsData);
				$specificationIds = [];

				foreach ($specificationsInfo as $specification) {
					$childrenCount = count($specification['children']);
					if ($childrenCount > 0) {
						$randomInt = random_int(0, $childrenCount - 1);
						$specificationIds[] = $specification['children'][$randomInt]['id'];
					}
				}

				$product->specifications()->attach($specificationIds);
			}
			Description::factory(100)->create();
			Media::factory(100)->create();
			SearchHint::factory(5)->create();
			Commentary::factory(2200)->create();

			// \App\Models\User::factory()->create([
			// 		'name' => 'Test User',
			// 		'email' => 'test@example.com',
			// ]);

			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();

			\Log::error($e->getMessage());
		}
	}
}
