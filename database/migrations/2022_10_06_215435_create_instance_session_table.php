<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instance_session', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instance_id')->constrained()->cascadeOnDelete();
            $table->foreignId('session_id')->nullable()->constrained();
            $table->date('date')->nullable();
            $table->foreignId('trainer_id')->nullable()->constrained()->onUpdate('cascade')->nullOnDelete();
            $table->foreignId('zoom_room_id')->nullable()->constrained('zoom_rooms')->nullOnDelete();
            $table->foreignId('cohort_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
            $table->index(['instance_id', 'session_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instance_session');
    }
};
