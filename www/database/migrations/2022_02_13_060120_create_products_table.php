<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->string('thumbnail', 255);
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->foreignId('category_id')
                ->constrained('categories')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');
            $table->timestamp('indexed_at')->nullable();    // Elastic indexing status
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
