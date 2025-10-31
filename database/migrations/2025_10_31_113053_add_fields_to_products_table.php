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
             if (Schema::hasColumn('products', 'price')) {
                $table->dropColumn('price');
            }
            $table->integer('quantity')->default(0)->after('name');
            $table->date('expiration_date')->nullable()->after('description');
            $table->boolean('status')->default(true)->after('expiration_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'quantity')) {
                $table->dropColumn('quantity');
            }
            if (Schema::hasColumn('products', 'expiration_date')) {
                $table->dropColumn('expiration_date');
            }
            if (Schema::hasColumn('products', 'status')) {
                $table->dropColumn('status');
            }

            // Restore the "price" column if you ever roll back
            $table->decimal('price', 8, 2)->nullable();
        });
    }
};
