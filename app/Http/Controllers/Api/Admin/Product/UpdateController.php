<?php

namespace App\Http\Controllers\Api\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\UpdateRequest;
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

class UpdateController extends Controller
{
	public function __invoke(UpdateRequest $request)
	{
		try {
			DB::beginTransaction();

			$data = $request->validated();

			$id = $data['id'];

			unset($data['id']);

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

			$product = Product::find($id);

			if (!isset($product)) {
				DB::rollBack();
				return response()->json(['error' => 'Такой продукт не существует!'], 404);
			}

			$statusUpdate = $product->update($data);

			if (!$statusUpdate) {
				DB::rollBack();
				return response()->json(['error' => 'Не обновился!'], 404);
			}

			$media = Media::where('product_id', $product->id);
			$existingMediaIds = collect($images)
				->filter(function ($image) {
					return isset($image['id']);
				})
				->pluck('id')
				->all();

			$media->whereNotIn('id', $existingMediaIds)->delete();

			foreach ($images as $key => $imageData) {
				if (isset($imageData['file'])) {
					$image = Image::make($imageData['file']);

					// Генерируйте уникальное имя для src_max
					$uniqueName = uniqid() . '_';

					$rootPath = 'project/product';

					// Изменение размера для src_max
					$image->resize(800, 1280, function ($constraint) {
						$constraint->aspectRatio();
						$constraint->upsize();
					});

					// Сохранение src_max с использованием Storage::disk
					$srcMaxName = $uniqueName . '(1280x800)' . '.' . $imageData['file']->getClientOriginalExtension();
					$srcMaxPath = $rootPath . '/src_max/' . $srcMaxName;
					Storage::disk('public')->put($srcMaxPath, $image->stream());

					// Изменение размера для src_average
					$image->resize(190, 235, function ($constraint) {
						$constraint->aspectRatio();
						$constraint->upsize();
					});

					// Сохранение src_average с использованием Storage::disk
					$srcAverageName = $uniqueName . '(190x235)' . '.' . $imageData['file']->getClientOriginalExtension();
					$srcAveragePath = $rootPath . '/src_average/' . $srcAverageName;
					Storage::disk('public')->put($srcAveragePath, $image->stream());

					// Изменение размера для src_min
					$image->resize(70, 85, function ($constraint) {
						$constraint->aspectRatio();
						$constraint->upsize();
					});

					// Сохранение src_min с использованием Storage::disk
					$srcMinName = $uniqueName . '(70x85)' . '.' . $imageData['file']->getClientOriginalExtension();
					$srcMinPath = $rootPath . '/src_min/' . $srcMinName;
					Storage::disk('public')->put($srcMinPath, $image->stream());
					$updatedTimestamp = now()->addSeconds($key);

					Media::create([
						"src_max" => $srcMaxName,
						"src_average" => $srcAverageName,
						"src_min" => $srcMinName,
						"product_id" => $product->id,
						"created_at" => $updatedTimestamp,
						"updated_at" => $updatedTimestamp
					]);
				} elseif (isset($imageData['id'])) {
					$mediaToUpdate = Media::where('product_id', $product->id)->where('id', $imageData['id'])->first();

					if (isset($mediaToUpdate)) {
						$updatedTimestamp = now()->addSeconds($key);

						$mediaToUpdate->update(['updated_at' => $updatedTimestamp]);
					}
				}
			}

			if (isset($tagIds)) {
				$product->tags()->sync($tagIds);
			}
			if (isset($specificationIds)) {
				$product->specifications()->sync($specificationIds);
			}
			if (isset($content) && mb_strlen(trim($content)) > 0) {
				$description = Description::create([
					"info" => $content,
					"product_id" => $product->id
				]);
			}

			if (isset($status)) {
				if ( $status == 0) {
					$product->delete();
				} else {
					$product->restore();
				}
			}
			DB::commit();

			return response()->json([
				'message' => 'Продукт было успешно обновленно!'
			], 201);
		} catch (QueryException $exception) {
			DB::rollBack();

			// return response()->json(['error' => 'Ошибка со стороны БД'], 500);
			return response()->json(['error' => $exception->getMessage()], 500);
		} catch (\Exception $exception) {
			DB::rollBack();

			// return response()->json(['error' => 'Ошибка со стороны сервера'], 500);
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