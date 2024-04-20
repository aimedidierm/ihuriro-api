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
        Schema::create('reported_documents', function (Blueprint $table) {
            $table->id();
            $table->string('document');
            $table->unsignedBigInteger("reported_id");
            $table->foreign("reported_id")->on("reporteds")->references("id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reported_documents');
    }
};
