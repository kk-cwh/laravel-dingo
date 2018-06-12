<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['title', 'name', 'status', 'parent_id', 'description'];


    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_menus', 'menu_id', 'role_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class,'parent_id','id');
    }

    public function parent()
    {
        return $this->hasOne(Menu::class,'id','parent_id');
    }


}
