<?php

use App\Models\Chat\ChatGroup;
use App\Models\Profile;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("chat_group_members", function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ChatGroup::class)->unique();
            $table->foreignIdFor(Profile::class);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("chat_group_members");
    }
};
