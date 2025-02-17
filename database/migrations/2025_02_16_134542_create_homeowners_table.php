<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('homeowners', function(Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('first_name')->nullable();
            $table->string('initial')->nullable();
            $table->string('last_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homeowners');
    }

};
