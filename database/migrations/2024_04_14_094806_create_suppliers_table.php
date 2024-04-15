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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('suplier_name') ; 
            $table->integer('contact') ;
            $table->string('address') ; 
            $table->text('description') ;
            $table->uuid('user_id') ; 
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products') ;
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade') ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
