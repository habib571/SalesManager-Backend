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
        Schema::create('invoiceproducts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id');
            $table->foreign('invoice_id')->references('id')->on('invoices'); 
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products'); 
            $table->uuid('user_id') ; 
            $table->foreign('user_id')->references('user_id')->on('users');  
            $table->integer('quantity') ;
            $table->integer('price') ;
            $table->integer('discount') ;
            $table->integer('amount') ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoiceproducts');
    }
};
