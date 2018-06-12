<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    protected $fillable = ['title','sub_title','name','status','parent_id','description'];

    public function role(){
        return $this->belongsToMany(Role::class,'role_permissions','permission_id','role_id');
    }
}
