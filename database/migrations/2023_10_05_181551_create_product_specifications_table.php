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
		Schema::create('product_specifications', function (Blueprint $table) {
			$table->id();

			$table->foreignId("product_id")->nullable()->constrained("products")->references("id");
			$table->foreignId("specification_id")->nullable()->constrained("specifications")->references("id");

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('product_specifications');
	}
};
