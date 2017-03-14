<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pid')->default(0)->comment('父级菜单');
            $table->string('name')->default('')->comment('菜单名称');
            $table->string('icon')->default('')->nullable()->comment('图标');
            $table->string('permission')->default('')->nullable()->comment('菜单对应的权限');
            $table->tinyInteger('only_permission')->default(0)->nullable()->comment('是否仅为权限，若仅为权限则不在菜单展示0:否,1:是');
            $table->string('url')->default('')->nullable()->comment('菜单链接地址');
            $table->string('active')->default('')->nullable()->comment('菜单高亮地址');
            $table->string('description')->default('')->nullable()->comment('描述');
            $table->tinyInteger('sort')->default(0)->nullable()->comment('排序');
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
        Schema::dropIfExists('menus');
    }
}
