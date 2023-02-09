<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->string('name', 50);
            $table->string('image', 30)->nullable();
            $table->string('slug', 30)->unique();
            $table->text('description')->nullable();
            $table->string('address', 100)->unique();
            $table->unsignedMediumInteger('members')->nullable();
            $table->unsignedMediumInteger('views')->default(0);
            $table->unsignedSmallInteger('daily_views')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
};
