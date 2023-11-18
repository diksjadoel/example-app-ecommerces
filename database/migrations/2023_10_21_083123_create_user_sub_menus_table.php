<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSubMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_sub_menus', function (Blueprint $table) {
            $table->id();
            $table->string('user_sub_menus_title');
            $table->string('user_sub_menus_url');
            $table->string('user_sub_menus_icons')->nullable();
            $table->enum('user_sub_menus_is_active',[0,1])->default(1);
            $table->integer('user_sub_menus_user_menu_id');
            $table->foreign('user_sub_menus_user_menu_id')->references('id')->on('user_menus')->onDelete('cascade');
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
        Schema::dropIfExists('user_sub_menus');
    }
}
