<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_currency', function (Blueprint $table) {
            $table->id();
            $table->integer('base_currency_id');
            $table->string('currency');
            $table->decimal('rate', 10, 4);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_currency');
    }
};
