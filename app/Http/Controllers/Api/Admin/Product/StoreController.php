<?php

namespace App\Http\Controllers\Api\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

use App\Models\Project\Product;
use App\Models\Project\Media;
use App\Models\Project\Description;
use App\Models\Project\Tag;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
	public function __invoke(StoreRequest $request)
	{
		try {
			DB::beginTransaction();

			$data = $request->validated();

			if (isset($data['status'])) {
				$status = $data['status'];
			}
			unset($data['status']);

			if (isset($data['images'])) {
				$images = $data['images'];
				$images = array_reverse($images);
			}
			unset($data['images']);

			if (isset($data['tags'])) {
				$tagIds = $this->getTagIds($data['tags']);
			}
			unset($data['tags']);

			if (isset($data['content'])) {
				$content = $data['content'];
			}
			unset($data['content']);

			if (isset($data['specification_ids'])) {
				$specificationIds = $data['specification_ids'];
			}
			unset($data['specification_ids']);

			$product = Product::create($data);

			if (isset($images) && count($images) > 0) {
				foreach ($images as $key => $imageData) {
					$image = Image::make($imageData);

					// Генерируйте уникальное имя для src_max
					$uniqueName = uniqid() . '_';

					$rootPath = 'project/product';

					// Изменение размера для src_max
					$image->resize(800, 1280, function ($constraint) {
						$constraint->aspectRatio();
						$constraint->upsize();
					});

					// Сохранение src_max с использованием Storage::disk
					$srcMaxName = $uniqueName . '(1280x800)' . '.' . $imageData->getClientOriginalExtension();
					$srcMaxPath = $rootPath . '/src_max/' . $srcMaxName;
					Storage::disk('public')->put($srcMaxPath, $image->stream(100));

					// Изменение размера для src_average
					$image->resize(202, 250, function ($constraint) {
						$constraint->aspectRatio();
						$constraint->upsize();
					});

					// Сохранение src_average с использованием Storage::disk
					$srcAverageName = $uniqueName . '(190x235)' . '.' . $imageData->getClientOriginalExtension();
					$srcAveragePath = $rootPath . '/src_average/' . $srcAverageName;
					Storage::disk('public')->put($srcAveragePath, $image->stream(100));

					// Изменение размера для src_min
					$image->resize(80, 100, function ($constraint) {
						$constraint->aspectRatio();
						$constraint->upsize();
					});

					// Сохранение src_min с использованием Storage::disk
					$srcMinName = $uniqueName . '(70x85)' . '.' . $imageData->getClientOriginalExtension();
					$srcMinPath = $rootPath . '/src_min/' . $srcMinName;
					Storage::disk('public')->put($srcMinPath, $image->stream(100));

					$updatedTimestamp = now()->addSeconds($key);

					Media::create([
						"src_max" => $srcMaxName,
						"src_average" => $srcAverageName,
						"src_min" => $srcMinName,
						"product_id" => $product->id,
						"created_at" => $updatedTimestamp,
						"updated_at" => $updatedTimestamp
					]);
				}
			}

			if (isset($tagIds)) {
				$product->tags()->attach($tagIds);
			}
			if (isset($specificationIds)) {
				$product->specifications()->attach($specificationIds);
			}
			if (isset($content) && mb_strlen(trim($content)) > 0) {
				$description = Description::create([
					"info" => $content,
					"product_id" => $product->id
				]);
			}

			if (isset($status) && $status == 0) {
				$product->delete();
			}

			DB::commit();

			return response()->json([
				'message' => 'Продукт было успешно созданно!'
			], 201);
		} catch (QueryException $exception) {
			DB::rollBack();

			return response()->json(['error' => 'Ошибка со стороны БД'], 500);
		} catch (\Exception $exception) {
			DB::rollBack();

			return response()->json(['error' => $exception->getMessage()], 500);
		}
	}
	private function getTagIds($tags)
	{
		$tagIds = [];
		foreach ($tags as $tag) {
			$tagModel = null;

			if (!isset($tag["id"])) {
				// Попытка найти тег по имени
				$tagModel = Tag::where('name', trim($tag["name"]))->first();

				if (!$tagModel) {
					// Если тег не найден, создайте новый тег
					$tagModel = Tag::create(["name" => $tag["name"]]);
				}
			} else {
				// Если задан ID, попробуйте найти тег по ID
				$tagModel = Tag::find($tag["id"]);
			}

			if ($tagModel) {
				$tagIds[] = $tagModel->id;
			}
		}

		return $tagIds;
	}
}
