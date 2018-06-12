<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id')->comment('角色id 自增');
            $table->string('name')->comment('角色名称');
            $table->tinyInteger('status')->default('1')->comment('是否启用/删除: 1 启用 0 未启用（软删除）');
            $table->string('description')->nullable();
            $table->timestamps();
        });


        Schema::create('user_roles', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->comment('用户表id ');
            $table->unsignedInteger('role_id')->comment('角色表id ');
            $table->tinyInteger('status')->default('1')->comment('是否启用/删除: 1 启用 0 未启用（软删除）');;
            $table->primary(['role_id', 'user_id']);
            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id')->comment('api接口权限id 自增 ');
            $table->string('title')->comment('权限主标题');
            $table->string('sub_title')->comment('权限副标题');
            $table->string('name')->comment('权限路由名称 对应laravel route路由name');
            $table->tinyInteger('status')->default('1')->comment('是否启用/删除: 1 启用 0 未启用（软删除）');;
            $table->string('description')->nullable();
            $table->integer('parent_id')->default('0');
            $table->timestamps();
        });

        Schema::create('role_permissions', function (Blueprint $table) {
            $table->unsignedInteger('role_id')->comment('角色表id ');
            $table->unsignedInteger('permission_id')->comment('权限表id ');
            $table->tinyInteger('status')->default('1')->comment('是否启用/删除: 1 启用 0 未启用（软删除）');;
            $table->primary(['permission_id', 'role_id']);
            $table->timestamps();

        });

        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id')->comment('菜单表id');
            $table->string('title')->comment('菜单标题 对应管理树形菜单标题');
            $table->string('name')->comment('前端路由name');
            $table->tinyInteger('status')->default('1')->comment('是否启用/删除: 1 启用 0 未启用（软删除）');;
            $table->string('description')->nullable();
            $table->integer('parent_id')->default('0');
            $table->timestamps();
        });

        Schema::create('role_menus', function (Blueprint $table) {
            $table->integer('role_id')->comment('角色表id');
            $table->integer('menu_id')->comment('菜单表id');
            $table->tinyInteger('status')->default('1')->comment('是否启用/删除: 1 启用 0 未启用（软删除）');;
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
        Schema::drop('user_roles');
        Schema::drop('role_permissions');
        Schema::drop('roles');
        Schema::drop('permissions');
    }
}
