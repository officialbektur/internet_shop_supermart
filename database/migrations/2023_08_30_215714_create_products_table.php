<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('products', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->unsignedBigInteger('price_old')->default(0);
			$table->unsignedBigInteger('price_now');
			$table->foreignId("category_id")->constrained("categories")->references("id");
			$table->string('hit')->default(0);
			$table->timestamps();

			$table->softDeletes();
		});
		// Устанавливаем начальное значение для автоинкрементного поля 'id'
		DB::statement('ALTER TABLE products AUTO_INCREMENT = 1000');
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('products');
	}
};
