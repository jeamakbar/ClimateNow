<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('carbon_calculations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('action_type', ['penanaman_pohon', 'pengurangan_plastik', 'pengurangan_emisi']);
            $table->integer('amount');
            $table->float('impact_value');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carbon_calculations');
    }
}; 