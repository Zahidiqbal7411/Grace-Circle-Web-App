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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->string('gender')->nullable();             // Male / Female
            $table->integer('age')->nullable();               // 26
            $table->string('country')->nullable();            // France
            $table->string('city')->nullable();               // Paris
            $table->dateTime('birthday')->nullable();
           // 1990-12-16
            $table->string('relationship_status')->nullable(); // Single
            $table->string('looking_for')->nullable();        // Man
            $table->string('work_as')->nullable();            // Designer
            $table->string('education')->nullable();          // Graduate Degree
            $table->string('languages')->nullable();          // French, Russian
            $table->string('interests')->nullable();          // Billiards
            $table->boolean('smoking')->nullable();           // No (0 or 1)
            $table->string('eye_color')->nullable();          // Brown
            $table->string('religion')->nullable();          // Brown
            $table->string('cast')->nullable();          // Brown

            // Optional: For photo gallery (9 slots — can be saved as JSON or separate table, here as JSON)
            $table->longText('about_us');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
