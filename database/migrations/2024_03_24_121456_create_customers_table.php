<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');

            $table->string('address')->nullable();
            $table->string('age')->nullable();
            $table->string('phone')->nullable();

            $table->enum('gender', ['male', 'female'])->nullable();

            $table->string('nomor_identitas')->nullable();
            $table->string('foto_identitas')->nullable();

            $table->string('email')->nullable();
            $table->string('identitas_type')->nullable();
            $table->string('keterangan')->nullable();
            $table->float('limit_pinjaman', 100)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
