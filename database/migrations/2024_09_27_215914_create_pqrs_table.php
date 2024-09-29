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
        Schema::create('pqrs', function (Blueprint $table) {
            $table->id('pqr_id');
            $table->date('pqr_date');
            $table->string('pqr_type');
            $table->string('pqr_methodnotify');
            $table->text('pqr_cause');
            $table->text('pqr_observation');
            $table->string('pqr_evidence')->nullable();
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pqrs');
    }
};
