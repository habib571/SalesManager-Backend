<?php

use App\Models\Category;
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
            $table->string('name');
            $table->integer('serial_number')->unique();
            $table->string('model');
           // $table->string('category_name') ;
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade') ;
            $table->uuid('user_id') ; 
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade') ;
            $table->string('sales_price');
            $table->integer('unit')->nullable();
            $table->string('image')->nullable();
            $table->integer('tax');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
