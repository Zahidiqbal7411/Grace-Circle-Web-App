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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();  // Chat message ID
            $table->unsignedBigInteger('sender_id');  // User who sent the message
            $table->unsignedBigInteger('receiver_id');  // User who receives the message
            $table->unsignedBigInteger('friend_id');  // The friendship relationship ID
            $table->text('message');  // Message content
            $table->enum('status', ['sent', 'delivered', 'read'])->default('sent');  // Status of message
            $table->timestamp('sent_at')->useCurrent();  // When the message was sent
            $table->timestamps();  // Created and Updated timestamps

            // Foreign keys
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('friend_id')->references('id')->on('friends')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
