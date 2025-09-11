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
        Schema::create('contact_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');              // contact name
            $table->string('email')->unique();   // email should be unique
            $table->string('password');          // hashed password
            $table->text('message');             // message content
            $table->timestamps();                // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_models');
    }
};
