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
        Schema::table('products', function (Blueprint $table) {
            $table->text("Product_Name")->nullable(true);
            $table->text("Product_Description")->nullable(true);
            $table->text("Name_Seo")->nullable(true);
            $table->text("Description_Seo")->nullable(true);
            $table->double("Price")->nullable(true);
            $table->set("Mode",["Free","Paid"])->default("Paid");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn(['Product_Name', 'Product_Description', 'Name_Seo','Description_Seo','Price','Mode']);
        });
    }
};
