<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_menus', function (Blueprint $table) {
            $table->id();
            $table->string('user_menus_title');
            $table->integer('user_menus_user_role_id');
            $table->foreign('user_menus_user_role_id')->references('id')->on('user_roles')->onDelete('cascade');
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
        Schema::dropIfExists('user_menus');
    }
}
