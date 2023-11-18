<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMenuHasPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_menu_has_permissions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_menu_has_permissions_user_menus_id');
            $table->integer('user_menu_has_permissions_user_permissions_id');
            $table->foreign('user_menu_has_permissions_user_menus_id')->references('id')->on('user_menus')->onDelete('cascade');
            $table->foreign('user_menu_has_permissions_user_permissions_id')->references('id')->on('permissions')->onDelete('cascade');
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
        Schema::dropIfExists('user_menu_has_permissions');
    }
}
