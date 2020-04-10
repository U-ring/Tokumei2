<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunityUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community_user', function (Blueprint $table) {
          $table->unsignedbigInteger('community_id');
          $table->unsignedbigInteger('user_id');
          $table->primary(['community_id','user_id']);
          // $table->primary(['group_id','user_id']);//primarykeyは、このテーブル内にしかない。
          $table->foreign('community_id')->references('id')->on('communities')->onDelete('cascade');
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('community_user');
    }
}
